<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class LevelUserPivotRepository extends ResourceRepository
{
    public function getAll()
    {
        return DB::table('level_crossings')->get();
    }

    public function getPaginate($n)
    {
        return DB::table('level_crossings')->paginate($n);
    }

    public function store(array $inputs)
    {
        return DB::table('level_crossings')->insert($inputs);
    }

    public function getByGodfatherId($user_id)
    {
        return DB::table('level_crossings')->where('user_id', '=', $user_id)->get();
    }

    public function getByLevelId($level_id)
    {
        return DB::table('level_crossings')->where('level_id', '=', $level_id)->get();
    }

    public function getByGodfatherIdAndLevelId($user_id, $level_id)
    {
        return DB::table('level_crossings')->where([
            ['user_id', '=', $user_id],
            ['level_id', '=', $level_id]
        ])->first();
    }

    public function updateRecord($user_id, $level_id, array $inputs)
    {
        return DB::table('level_crossings')->where([
            ['user_id', '=', $user_id],
            ['level_id', '=', $level_id]
        ])->update($inputs);
    }

    public function isRecordDoesntExists($user_id, $level_id)
    {
        return DB::table('level_crossings')->where([
            ['user_id', '=', $user_id],
            ['level_id', '=', $level_id]
        ])->get()->isEmpty();
    }

}
