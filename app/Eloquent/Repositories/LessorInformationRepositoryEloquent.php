<?php

namespace App\Eloquent\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contract\Repositories\LessorInformationRepository;
use App\Entities\LessorInformation;
use App\Validators\LessorInformationValidator;

/**
 * Class LessorInformationRepositoryEloquent.
 *
 * @package namespace App\Eloquent\Repositories;
 */
class LessorInformationRepositoryEloquent extends BaseRepository implements LessorInformationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessorInformation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
