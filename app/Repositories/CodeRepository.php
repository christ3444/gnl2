<?php

namespace App\Repositories;

use App\Models\CodeTransfer;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class CodeRepository extends ResourceRepository
{

    public function getAnAdminGenerationRecords()
    {
        return DB::table('marks')->where('action_id', '=', config('util.mark_actions')[0]['id'])
            ->join('users', 'users.id', '=', 'marks.user_id')
            ->select('marks.*', 'users.pseudo as generator_pseudo')
            ->latest()
            ->get();
    }

    public function generateCodes($generator_id, $amount)
    {
        $person = Person::where('user_id', $generator_id)->with('user')->first();
        if ($person->user->role_id < config('util.roles.admin.id')) {
            return 0;
        }

        $person->number_of_code += $amount;
        $person->save();

        return 1;
    }


    public function transferCode($sender_id, $recever_id, $amount)
    {
        $sender = Person::where('user_id', $sender_id)->first();
        $recever = Person::where('user_id', $recever_id)->first();

        $recever->number_of_code += $amount;
        $recever->save();

        $sender->number_of_code -= $amount;
        $sender->save();

        CodeTransfer::create([
            'sender_id' => $sender_id,
            'recever_id' => $recever_id,
            'amount' => $amount
        ]);
        
        return 1;
    }
}
