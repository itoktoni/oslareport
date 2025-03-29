<?php

namespace App\Dao\Repositories\Core;

trait UserRepository
{
    public function dataRepository()
    {
        $query = $this->model
            ->select($this->model->getSelectedField())
            ->leftJoinRelationship('has_role')
            ->active()
            ->sortable()
            ->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }
}
