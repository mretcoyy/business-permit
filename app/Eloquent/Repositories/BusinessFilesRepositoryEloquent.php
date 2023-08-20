<?php

namespace App\Eloquent\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contract\Repositories\BusinessFilesRepository;
use App\Entities\BusinessFiles;
use App\Validators\BusinessFilesValidator;

/**
 * Class BusinessFilesRepositoryEloquent.
 *
 * @package namespace App\Eloquent\Repositories;
 */
class BusinessFilesRepositoryEloquent extends BaseRepository implements BusinessFilesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessFiles::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
