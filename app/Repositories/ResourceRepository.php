<?php

namespace App\Repositories;

abstract class ResourceRepository
{

    protected $model;

    public function whereClause($clauses)
    {
        return $this->model->where($clauses);
    }

    public function getCountByWhere($clauses)
    {
        return $this->whereClause($clauses)->count();
    }

    public function getTableCount()
    {
        return $this->model->count();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }

    public function take($limit)
    {
        return $this->model
            ->latest()
            ->take($limit)
            ->get();
    }

    public function store(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $inputs)
    {
        return $this->getById($id)->update($inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
