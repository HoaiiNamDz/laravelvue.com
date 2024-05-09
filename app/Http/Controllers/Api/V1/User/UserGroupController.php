<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserGroup\UserGroupCreateRequest;
use App\Services\Interfaces\User\UserGroupServiceInterface as UserGroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Enums\ResponseEnum;
use App\Http\Resources\UserGroupResource;

class UserGroupController extends Controller
{
    protected $userGroupService;

    public function __construct(
        UserGroupService $userGroupService,
    ) {
        $this->userGroupService = $userGroupService;
    }

    public function index(Request $request)
    {
        if($request->has('id')) {
            $userGroupById = $request->input('id');
            $userGroup = $this->userGroupService->getUsersByGroupId($userGroupById);
            // custom response trả ra
            return (new UserGroupResource($userGroup))->toArray($request); 
        } else {
            $userGroup = $this->userGroupService->paginate($request);
            return response()->json($userGroup, 200);
        }
    }

    public function create(UserGroupCreateRequest $request)
    {
        if ($this->userGroupService->create($request)) {
            return response()->json([
                'message' => 'Thêm mới bản ghi thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 422);
    }

    public function updateStatus(Request $request)
    {

        // $model = $request->input('model');
        // $subFolder = str_replace('Group', '', $model);
        // $folder = 'Services' . '\\' . $subFolder;
        // $interface = 'Service';
        // $class = loadClass($model, $folder, $interface);
        if ($this->userGroupService->updateStatus($request)) {
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 500);
    }

    public function updateStatusMultiple(Request $request) {
        if ($this->userGroupService->updateStatusMultiple($request)) {
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 500);
    }

    public function deleteMultiple(Request $request) {
        if($this->userGroupService->deleteMultiple($request)) {
            return response()->json([
                'message' => 'Xoá dữ liệu thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Xóa dữ liệu thất bại'
        ], 500);
    }

    public function delete(Request $request) {
        if($this->userGroupService->deleteRow($request)) {
            return response()->json([
                'message' => 'Xoá dữ liệu thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Xóa dữ liệu thất bại'
        ], 500);
    }

    public function update(Request $request) {
        if ($this->userGroupService->update($request)) {
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 500);
    }
}
