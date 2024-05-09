<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }
}
