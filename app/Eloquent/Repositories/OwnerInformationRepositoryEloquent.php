<?php

namespace App\Eloquent\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contract\Repositories\OwnerInformationRepository;
use App\Entities\OwnerInformation;
use App\Validators\OwnerInformationValidator;

/**
 * Class OwnerInformationRepositoryEloquent.
 *
 * @package namespace App\Eloquent\Repositories;
 */
class OwnerInformationRepositoryEloquent extends BaseRepository implements OwnerInformationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OwnerInformation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
