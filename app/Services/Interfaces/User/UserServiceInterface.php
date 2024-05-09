<?php

namespace App\Services\Interfaces\User;

interface UserServiceInterface
{
    public function create($request);
    public function paginate($request);
    public function updateStatus($request);
    public function deleteMultiple($request);
    public function updateStatusMultiple($request);
    public function deleteRow($request);
    public function getUserById($id);
    public function update($request);
}
