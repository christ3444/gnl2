<?php

namespace App\Repositories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends ResourceRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        return $this->model->with('person', 'role')->get();
    }

    public function getAllByJoin()
    {
        return DB::table('users')
            ->join('people', 'people.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'people.*', 'roles.*')
            ->latest('users.created_at')
            ->get();
    }

    public function take($limit)
    {
        return Person::where('level_number', '>=', 2)->with('user')
            ->latest()
            ->take($limit)
            ->get();
    }


    public function getRole($user_id)
    {
        return $this->getById($user_id)->role->role;
    }

    public function getPassword($user_id)
    {
        return $this->model->find($user_id)->password;
    }

    public function exists($field, $value)
    {
        return $this->model->where($field, $value)->exists();
    }

    public function getByField($field, $value)
    {
        return $this->model->with(['role', 'person'])->where($field, $value)->first();
    }

    public function getUserGodsons($user_id)
    {
        return $this->whereClause([['godfather_id', '=', $user_id]])->with('person')->get();
    }

    public function isGodfatherHasTwoDirectGodsons($godfather_id)
    {
        return $this->whereClause([['godfather_id', '=', $godfather_id]])->count() == config('util.maximum_godsons_of_generation_one');
    }

    public function setGodsonsGenerationNumberOnTheirGodfatherTree(&$godsons, $generation)
    {
        foreach ($godsons as $godson) {
            $godson->generation = $generation;
        }

        return $godsons;
    }

    public function getAGenerationGodsonsOfAGodfather($godfather_id, $generation)
    {
        $godsons = $this->getUserGodsons($godfather_id)->all();
        if ($generation === 1) {
            return $godsons;
        } else {
            for ($i = 0; $i < $generation; $i++) {
                $iterable = $godsons;
                $godsons = array();
                foreach ($iterable as $godfather) {
                    $godsons = array_merge(
                        $godsons,
                        $this->getUserGodsons($godfather->id)->all()
                    );
                }
                $i++;
            }
            return $godsons;
        }
    }

    public function getGodsonsTreeUntilAGenerationOfAGodfather($godfather_id, $generation)
    {
        $tree = array();

        for ($i = 1; $i <= $generation; $i++) {
            $godsons = $this->getAGenerationGodsonsOfAGodfather($godfather_id, $i);
            $tree = array_merge(
                $tree, 
                $this->setGodsonsGenerationNumberOnTheirGodfatherTree(
                    $godsons, $i
                )
            );
        }

        return $tree;
    }
}
