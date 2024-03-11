<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository extends ResourceRepository
{
    public function __construct(Level $level)
    {
        $this->model = $level;
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }

    public function getColumnValue($where_clauses, $column)
    {
        return $this->whereClause($where_clauses)->value($column);
    }
}
