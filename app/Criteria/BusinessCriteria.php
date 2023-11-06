<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;
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
            $model->where('business.user_id', $filters->user_id);
        }

        if (isset($filters->status) && $filters->status != '') {
            if ($filters->status == BusinessStatus::NEW || $filters->status == BusinessStatus::RENEW) {
                $model->whereIn('business_detail.status', [BusinessStatus::NEW, BusinessStatus::RENEW]);
            } else {
                $model->where('business_detail.status', $filters->status);
            }
        }

        if (isset($filters->bin) && $filters->bin != '') {
            $model->where('business_detail.bin','like','%'. $filters->bin .'%');
        }


        return $model;
    }
}
