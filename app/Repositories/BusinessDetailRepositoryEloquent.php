<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BusinessDetailRepository;
use App\Entities\BusinessDetail;
use App\Validators\BusinessDetailValidator;

/**
 * Class BusinessDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessDetailRepositoryEloquent extends BaseRepository implements BusinessDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
