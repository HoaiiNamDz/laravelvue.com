<?php

namespace App\Services\User;

use App\Services\Interfaces\User\UserGroupServiceInterface;
use App\Repositories\Interfaces\User\UserGroupRepositoryInterface as UserGroupRepository;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

/**
 * Class UserService
 * @package App\Services
 */
class UserGroupService extends BaseService implements UserGroupServiceInterface
{
    protected $userGroupRepository;
    protected $payload = ['name', 'description', 'publish'];
    protected $fieldSearch = ['name'];
    public function __construct(
        UserGroupRepository $baseRepo
    ) {
        // $this->userGroupRepository = $userGroupRepository;
        parent::__construct($baseRepo);
    }
    public function paginate($request)
    {
        $perpage = $request->input('perpage') ? $request->input('perpage') : 4;
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->input('publish'),
        ];
        $relation = ['users'];
        $userGroup = $this->baseRepo->pagination($perpage, $condition, $this->fieldSearch, $relation);
        return $userGroup;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $userGroup = $this->baseRepo->create($payload);
            DB::commit();
            return $userGroup;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
