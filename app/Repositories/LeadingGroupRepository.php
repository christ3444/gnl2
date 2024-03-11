<?php

namespace App\Repositories;

use App\Models\LeadingGroup;

class LeadingGroupRepository extends ResourceRepository
{
    public function __construct(LeadingGroup $leadingGroup)
    {
        $this->model = $leadingGroup;
    }

    public function getAllActive()
    {
        return $this->model->where('active', true)->get();
    }
}
