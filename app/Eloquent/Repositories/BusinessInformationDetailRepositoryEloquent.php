<?php

namespace App\Eloquent\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contract\Repositories\BusinessInformationDetailRepository;
use App\Entities\BusinessInformationDetail;
use App\Validators\BusinessInformationDetailValidator;

/**
 * Class BusinessInformationDetailRepositoryEloquent.
 *
 * @package namespace App\Eloquent\Repositories;
 */
class BusinessInformationDetailRepositoryEloquent extends BaseRepository implements BusinessInformationDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessInformationDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
