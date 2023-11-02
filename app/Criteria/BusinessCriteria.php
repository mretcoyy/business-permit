<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

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
        $filters = (object) $this->filters;

        if (isset($filters->business_id) && $filters->business_id != '') {
            $model->where('business.id', $filters->id);
        }

        if (isset($filters->user_id) && $filters->user_id != '') {
            $model->where('business.user_id', $filters->user_id);
        }

        return $model;
    }
}
