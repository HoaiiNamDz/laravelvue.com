<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseService implements BaseServiceInterface
{
    protected $baseRepo;

    public function __construct(
        $baseRepo = null
    ) {
        $this->baseRepo = $baseRepo;
    }

    public function updateStatus($request)
    {
        DB::beginTransaction();
        try {
            $payload[$request->input('field')] = (($request->input('checked') == false) ? 1 : 2);
            // $model = $request->input('model');
            // $folder = 'Repositories' . "\\" . $subFolder;
            // $interface = 'Repository';
            // $class = loadClass($model, $folder, $interface);

            // $class->update($request->input('id'), $payload);
            $this->baseRepo->updateStatus($request->input('id'), $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function updateStatusMultiple($request)
    {
        DB::beginTransaction();
        try {
            $payload[$request->input('field')] = $request->input('value');
            $this->baseRepo->updateStatusByIds($request->input('ids'), $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function deleteMultiple($request) {
        DB::beginTransaction();
        try {
            $ids = explode(',', $request->input('ids'));
            $this->baseRepo->deleteMultiple($ids);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function deleteRow($request) {
        DB::beginTransaction();
        try {
            $this->baseRepo->deleteRow($request->input('id'));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function getUsersByGroupId($id) {
        return $this->baseRepo->getUsersByGroupId($id);
    }

    public function getUserById($id) {
        return $this->baseRepo->getUserById($id);
    }

    public function update($request) {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'description');
            $this->baseRepo->update($request->query('id'), $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
