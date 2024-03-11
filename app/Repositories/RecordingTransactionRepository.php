<?php

namespace App\Repositories;

use App\Models\RecordingTransaction;
use Illuminate\Support\Facades\DB;

class RecordingTransactionRepository extends ResourceRepository
{
    public function __construct(RecordingTransaction $recordingTransaction)
    {
        $this->model = $recordingTransaction;
    }

    public function getAllByJoin()
    {
        return DB::table('recording_transactions')
            ->join('users as u1', 'u1.id', '=', 'recording_transactions.payer_id')
            ->join('users as u2', 'u2.id', '=', 'recording_transactions.recorded_id')
            ->select('recording_transactions.*', 'u1.pseudo as payer_pseudo', 'u2.pseudo as recorded_pseudo')
            ->latest()
            ->get();
    }

    public function getARecorderCertainAmount($user_id, $amount)
    {
        DB::table('recording_transactions')->where('payer_id', $user_id)
            ->join('users as u2', 'u2.id', '=', 'recording_transactions.recorded_id')
            ->select('recording_transactions.*', 'u2.pseudo as recorded_pseudo')
            ->take($amount)
            ->get();    
    }

    public function getAllOfUserAsPayerByJoin($payer_id)
    {
        return DB::table('recording_transactions')
            ->where('payer_id', $payer_id)
            ->join('users', 'recording_transactions.recorded_id', '=', 'users.id')
            ->select('recording_transactions.*', 'users.pseudo as recorded_pseudo')
            ->latest()
            ->get();
    }

    public function getPayerRecordingCount($payer_id)
    {
        return $this->model->where('payer_id', $payer_id)->count();
    }
}
