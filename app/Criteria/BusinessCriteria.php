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

        if (isset($filters->business_status) && $filters->business_status) {
            $model->where('business_detail.business_status', $filters->business_status);
        }

        if (isset($filters->status) && $filters->status != '') {
            if ($filters->status == BusinessStatus::NEW || $filters->status == BusinessStatus::RENEW) {
                $model->whereIn('business_detail.status', [BusinessStatus::NEW, BusinessStatus::RENEW]);
            } else {
                $model->where('business_detail.status', $filters->status);
            }
        }

        if (isset($filters->search_keyword) && $filters->search_keyword != '') {
            $model->where('business_detail.bin', 'LIKE', '%'.$filters->search_keyword.'%')
            ->orWhere('business_information.business_name', 'LIKE',  '%'.$filters->search_keyword.'%')
            ->orWhere(DB::raw("CONCAT(business_information.first_name, ' ', business_information.last_name)"), 'LIKE',  '%'.$filters->search_keyword.'%')
            ->where('business_detail.status', $filters->status);
        }

        if (isset($filters->is_null) && $filters->is_null == true) {
            $model->where('business.user_id', null);
        }

        return $model;
    }
}
