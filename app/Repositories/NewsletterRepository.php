<?php

namespace App\Repositories;

use App\Models\Newsletter;

class NewsletterRepository extends ResourceRepository
{
    public function __construct(Newsletter $newsletter)
    {
        $this->model = $newsletter;
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }
}
