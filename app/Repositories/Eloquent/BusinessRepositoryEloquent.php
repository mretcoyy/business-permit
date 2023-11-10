<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contract\BusinessRepository;
use App\Entities\Business;
use App\Validators\BusinessValidator;
use Illuminate\Support\Facades\DB;
use App\Criteria\BusinessCriteria;

/**
 * Class BusinessRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessRepositoryEloquent extends BaseRepository implements BusinessRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Business::class;
    }

    public function list($filters = [], $isForExport = false)
    {
        $this->model = $this->model
            ->select([
                'business.id',
                'user_id',
                'reference_number',
                'dti_registration_no',
                'dti_date_of_registration',
                'type_of_organization',
                'is_tax_incentive',
                'date_of_application',
                'business.created_at',
                'business.updated_at'
            ])
            ->leftJoin(
                'business_detail',
                'business_detail.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'business_information',
                'business_information.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'business_information_detail',
                'business_information_detail.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'business_files',
                'business_files.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'lessor_information',
                'lessor_information.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'owners_information',
                'owners_information.business_id',
                '=',
                'business.id'
            )
            ->leftJoin(
                'users',
                'business.user_id',
                '=',
                'users.id'
            )
            ->distinct('business_id');

            $this->pushCriteria(new BusinessCriteria($filters))->applyCriteria();

            $result = $this->model->get();

            return $result;
    }
    
}
