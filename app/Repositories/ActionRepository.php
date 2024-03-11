<?php

namespace App\Repositories;

use App\Models\Action;

class ActionRepository extends ResourceRepository
{
    public function __construct(Action $action)
    {
        $this->model = $action;
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }
}
