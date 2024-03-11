<?php

namespace App\Repositories;

use App\Models\Mark;
use Illuminate\Support\Facades\DB;

class MarkRepository extends ResourceRepository
{
    public function __construct(Mark $mark)
    {
        $this->model = $mark;
    }

    public function getAllByJoin()
    {
        return DB::table('marks')->where('action_id', '>', config('util.mark_actions')[0]['id'])
            ->join('users', 'users.id', '=', 'marks.user_id')
            ->join('actions', 'actions.id', '=', 'marks.action_id')
            ->select('marks.*', 'users.pseudo as occurrer_pseudo', 'actions.action as mark_action', 'actions.code as mark_code')
            ->latest()
            ->get();
    }
}
