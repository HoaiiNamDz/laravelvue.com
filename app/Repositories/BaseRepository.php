<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }
    public function pagination(
        int $perpage = 2,
        array $condition = [],
        array $fieldSearch = [],
        array $relation  = []
    ) {
        return $this->model
            ->keyword($condition['keyword'] ?? null,)
            ->publish($condition['publish'] ?? null,)
            ->RelationCount($relation)
            ->paginate($perpage);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function updateStatus(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        $model->publish = $payload['publish'];
        $model->save();
        return $model;
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function deleteMultiple(array $ids = []) {
        $models =  $this->model->whereIn('id',$ids)->get();
        foreach($models as $model) {
            $model->is_disabled = 1;
            $model->delete();
            $model->save();
        }
        return $models;
    }

    public function deleteRow($id = 0) {
        $model = $this->findById($id);
        $model->is_disabled = 1;
        $model->delete();
        $model->save();
        return $model;
    }

    public function updateStatusByIds(array $ids = [], $payload = []) {
        return $this->model->whereIn('id',$ids)->update($payload);
    }

    public function getUsersByGroupId($id)
    {
        return $this->findById($id);
    }

    public function getUsersById($id)
    {
        return $this->findById($id);
    }

    public function update(int $id = 0, array $payload = []) {
        $model = $this->findById($id);
        $model->name = $payload['name'];
        $model->description = $payload['description'];
        $model->save();
        return $model;
    }

    public function all() {
        return $this->model->all();
    }
}
