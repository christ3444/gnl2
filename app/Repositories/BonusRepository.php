<?php

namespace App\Repositories;

use App\Models\Bonus;
use Illuminate\Support\Facades\DB;

class BonusRepository extends ResourceRepository
{

    public function __construct(Bonus $bonus)
    {
        $this->model = $bonus;
    }

    public function getBeneficiaryBonusAmountTotal($beneficiary_id)
    {
        return $this->model->where('beneficiary_id', $beneficiary_id)->sum('amount');
    }

    public function isRecordDoesntExistForThisGodson($beneficiary_id, $godson_id, $level_id)
    {
        return $this->whereClause([
            ['beneficiary_id', '=', $beneficiary_id],
            ['godson_id', '=', $godson_id],
            ['level_id', '=', $level_id]
        ])->get()->isEmpty();
    }

    public function getForBeneficiary($beneficiary_id)
    {
        return DB::table('bonuses')->where('beneficiary_id', '=', $beneficiary_id)
            ->join('levels', 'levels.id', '=', 'bonuses.level_id')
            ->join('users', 'users.id', '=', 'bonuses.godson_id')
            ->select('bonuses.*', 'levels.label as level_label', 'users.pseudo as godson_pseudo')
            ->latest()
            ->get();
    }

    public function getForBeneficiaryCount($beneficiary_id)
    {
        return $this->model->where('beneficiary_id', '=', $beneficiary_id)->count();
    }
}
