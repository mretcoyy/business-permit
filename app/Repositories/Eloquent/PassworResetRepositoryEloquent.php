<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contract\PassworResetRepository;
use App\Entities\PassworReset;
use App\Validators\PassworResetValidator;

/**
 * Class PassworResetRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PassworResetRepositoryEloquent extends BaseRepository implements PassworResetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PassworReset::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
