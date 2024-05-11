<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function create();
    public function pagination(int $perpage = 2, array $condition = [], array $fieldSearch = [], array $relation  = []);
    public function updateStatus(int $id = 0, array $payload = []);
    public function findById(int $modelId, array $column = ['*'], array $relation = []);
    public function deleteMultiple(array $ids = []);
}
