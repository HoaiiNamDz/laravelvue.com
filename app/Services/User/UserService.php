<?php

namespace App\Services\User;

use App\Services\Interfaces\User\UserServiceInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService implements UserServiceInterface
{
    protected $userRepository;
    protected $payload = ['name', 'description', 'publish'];
    protected $fieldSearch = ['name'];
    public function __construct(
        UserRepository $baseRepo
    ) {
        // $this->userRepository = $userRepository;
        parent::__construct($baseRepo);
    }
    public function paginate($request)
    {
        $perpage = $request->input('perpage') ? $request->input('perpage') : 4;
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->input('publish'),
        ];
        
        $users = $this->baseRepo->pagination($perpage, $condition, $this->fieldSearch);
        return $users;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $user = $this->baseRepo->create($payload);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
