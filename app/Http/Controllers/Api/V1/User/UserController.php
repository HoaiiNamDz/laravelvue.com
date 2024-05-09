<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserCreateRequest;
use App\Services\Interfaces\User\UserServiceInterface as UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Enums\ResponseEnum;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if($request->has('id')) {
            $userById = $request->input('id');
            $users = $this->userService->getUserById($userById);
            // custom response trả ra
            return (new UserResource($users))->toArray($request); 
        } else {
            $users = $this->userService->paginate($request);
            return response()->json($users, 200);
        }
    }

    public function updateStatus(Request $request)
    {

        // $model = $request->input('model');
        // $subFolder = str_replace('Group', '', $model);
        // $folder = 'Services' . '\\' . $subFolder;
        // $interface = 'Service';
        // $class = loadClass($model, $folder, $interface);
        if ($this->userService->updateStatus($request)) {
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 500);
    }

    public function updateStatusMultiple(Request $request) {
        if ($this->userService->updateStatusMultiple($request)) {
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công'
            ], 200);
        }
        return response()->json([
            'message' => 'Có lỗi xảy ra'
        ], 500);
    }
}
