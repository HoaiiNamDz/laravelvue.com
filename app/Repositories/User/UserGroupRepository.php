<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\User\UserGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\UserGroup;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserGroupRepository extends BaseRepository implements UserGroupRepositoryInterface
{
    protected $model;

    public function __construct(
        UserGroup $model
    ) {
        $this->model = $model;
    }
}
