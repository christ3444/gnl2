<?php

namespace App\Repositories;

use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\DB;

class WithdrawalRequestRepository extends ResourceRepository
{

    public function __construct(WithdrawalRequest $withdrawalRequest)
    {
        $this->model = $withdrawalRequest;
    }

    public function getAllProcessedByJoin()
    {
        return  DB::table('withdrawal_requests')
            ->where('processed', '=', true)
            ->join('users', 'withdrawal_requests.claimant_id', '=', 'users.id')
            ->join('leading_groups', 'withdrawal_requests.leading_group_id', '=', 'leading_groups.id')
            ->select('withdrawal_requests.*', 'users.pseudo as claimant_pseudo', 'leading_groups.name as leading_group_name')
            ->latest()
            ->get();
    }

    public function getAllProcessedOfUserByJoin($user_id)
    {
        return  DB::table('withdrawal_requests')->where('claimant_id', $user_id)
            ->where('processed', '=', true)
            ->join('leading_groups', 'withdrawal_requests.leading_group_id', '=', 'leading_groups.id')
            ->select('withdrawal_requests.*', 'leading_groups.name')
            ->latest()
            ->get();
    }

    public function getAllNotProcessedByJoin()
    {
        return  DB::table('withdrawal_requests')
            ->where('processed', '=', false)
            ->join('users', 'withdrawal_requests.claimant_id', '=', 'users.id')
            ->join('leading_groups', 'withdrawal_requests.leading_group_id', '=', 'leading_groups.id')
            ->select('withdrawal_requests.*', 'users.pseudo as claimant_pseudo', 'leading_groups.name as leading_group_name')
            ->latest()
            ->get();
    }

    public function getAllNotProcessedOfUserByJoin($user_id)
    {
        return  DB::table('withdrawal_requests')->where('claimant_id', $user_id)
            ->where('processed', '=', false)
            ->join('leading_groups', 'withdrawal_requests.leading_group_id', '=', 'leading_groups.id')
            ->select('withdrawal_requests.*', 'leading_groups.name')
            ->latest()
            ->get();
    }

    public function getClaimantCertainWithdrawalRequests($claimant_id, $limit)
    {
        return $this->model->where('claimant_id', $claimant_id)
            ->with('leading_group')
            ->latest()
            ->take($limit)
            ->get();
    }


    public function getClaimantWithdrawalAmountTotal($claimant_id)
    {
        return $this->whereClause([
            ['claimant_id', '=', $claimant_id],
            ['processed', '=', true]
        ])->sum('amount');
    }

}
