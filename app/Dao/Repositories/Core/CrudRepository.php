<?php

namespace App\Dao\Repositories\Core;

use Illuminate\Database\QueryException;
use Plugins\Notes;

trait CrudRepository
{
    public function dataRepository()
    {
        $query = $this
            ->select($this->getSelectedField())
            ->sortable()
            ->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->create($request);
            return Notes::create($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($request, $code)
    {
        try {
            $update = $this->findOrFail($code);
            $update->update($request);

            return Notes::update($update);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($request)
    {
        try {
            is_array($request) ? $this->destroy(array_values($request)) : $this->destroy($request);

            return Notes::delete($request);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function singleRepository($code, $relation = false)
    {
        try {
            return $relation ? $this->with($relation)->findOrFail($code) : $this->findOrFail($code);
        } catch (QueryException $ex) {
            abort(500, $ex->getMessage());
        }
    }
}
