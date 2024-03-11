<?php

namespace App\Repositories;

use App\Models\CodeTransfer;
use Illuminate\Support\Facades\DB;

class CodeTransferRepository extends ResourceRepository
{
    public function __construct(CodeTransfer $codeTransfer)
    {
        $this->model = $codeTransfer;
    }

    public function getAll()
    {
        return DB::table('code_transfers')
            ->join('users as u1', 'u1.id', '=', 'code_transfers.sender_id')
            ->join('users as u2', 'u2.id', '=', 'code_transfers.recever_id')
            ->select('code_transfers.*', 'u1.pseudo as sender_pseudo', 'u2.pseudo as recever_pseudo')
            ->latest()
            ->get();
    }

    public function getAllOfUserAsSender($sender_id)
    {
        return DB::table('code_transfers')
            ->where('sender_id', $sender_id)
            ->join('users', 'users.id', '=', 'code_transfers.recever_id')
            ->select('code_transfers.*', 'users.pseudo as recever_pseudo')
            ->latest()
            ->get();
    }
}
