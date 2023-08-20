<?php

namespace App\Eloquent\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contract\Repositories\BusinessInformationRepository;
use App\Entities\BusinessInformation;
use App\Validators\BusinessInformationValidator;

/**
 * Class BusinessInformationRepositoryEloquent.
 *
 * @package namespace App\Eloquent\Repositories;
 */
class BusinessInformationRepositoryEloquent extends BaseRepository implements BusinessInformationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessInformation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
