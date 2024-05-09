<?php

namespace App\Services\Interfaces\User;

interface UserGroupServiceInterface
{
    public function create($request);
    public function paginate($request);
    public function updateStatus($request);
    public function deleteMultiple($request);
    public function updateStatusMultiple($request);
    public function deleteRow($request);
    public function getUsersByGroupId($id);
    public function update($request);
}
