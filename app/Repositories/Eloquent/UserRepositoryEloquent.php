<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contract\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\DB;
use App\Criteria\UserCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function list($filters = [], $isForExport = false)
    {
        $this->model = $this->model
            ->select([
                '*'
            ]);

        $this->pushCriteria(new UserCriteria($filters))->applyCriteria();

        $result = $this->model->get();

        return $result;
    }
    
}
