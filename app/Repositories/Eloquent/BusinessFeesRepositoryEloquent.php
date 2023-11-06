<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contract\BusinessFeesRepository;
use App\Entities\BusinessFees;
use App\Validators\BusinessFeesValidator;

/**
 * Class BusinessFeesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class BusinessFeesRepositoryEloquent extends BaseRepository implements BusinessFeesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessFees::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
