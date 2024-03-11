<?php

namespace App\Repositories;

use App\Models\Bonus;
use App\Models\Person;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Hash;

class PersonRepository extends ResourceRepository
{
    protected $userRepository, $bonusRepository, $withdrawalRequestRepository;

    public function __construct(Person $person)
    {
        $this->model = $person;
    }

    public function getByUserId($user_id)
    {
        return $this->model->where('user_id', $user_id)->first();
    }

    public function getUserByPersonId($person_id)
    {
        return User::findOrFail($this->getById($person_id)->user_id);
    }

    public function updateBalance($user_id)
    {
        $person = $this->getByUserId($user_id);
        return $this->update($person->id, [
            'balance' => Bonus::where('beneficiary_id', $user_id)->sum('amount')
                        - WithdrawalRequest::where([
                            ['claimant_id', '=', $user_id],
                            ['processed', '=', true]
                        ])->sum('amount')
        ]);
    }

    public function isTransactionPassword($user_id, $transaction_password)
    {
        $person = $this->getByUserId($user_id);
        return Hash::check($transaction_password, $person->transaction_password);
    }
}
