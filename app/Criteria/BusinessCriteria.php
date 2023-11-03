<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Log;

/**
 * Class BusinessCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class BusinessCriteria implements CriteriaInterface
{
    protected $filters;
    

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    public function apply($model, RepositoryInterface $repository)
    {
        $filters = $this->filters;

        if (isset($filters->business_id) && $filters->business_id != '') {
            $model->where('business.id', $filters->business_id);
        }

        if (isset($filters->user_id) && $filters->user_id != '') {
            log::info('test');
            $model->where('business.user_id', $filters->user_id);
        }

        return $model;
    }
}
