<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;
use Illuminate\Support\Facades\DB;

/**
 * Class BusinessCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class AuditTrailCriteria implements CriteriaInterface
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
        if (isset($filters->date_from) && isset($filters->date_to)) {
            $date_from = Date('Y-m-d', strtotime($filters->date_from)). ' 00:00:00';
            $date_to = Date('Y-m-d', strtotime($filters->date_to)). ' 23:59:59';
          
            $model->where('audit_trail.created_at','>=', $date_from)
            ->orWhere('audit_trail.created_at','<=', $date_to);
        }
        return $model;
    }
}
