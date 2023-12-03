<?php

namespace App\Repositories\Eloquent;

use App\Criteria\AuditTrailCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contract\AuditTrailsRepository;
use App\Entities\AuditTrails;
use App\Validators\AuditTrailsValidator;

/**
 * Class AuditTrailsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AuditTrailsRepositoryEloquent extends BaseRepository implements AuditTrailsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AuditTrails::class;
    }

    public function list($filters, $isForExport = false)
    {
        $date_from = Date('Y-m-d', strtotime($filters->date_from)). ' 00:00:00';
        $date_to = Date('Y-m-d', strtotime($filters->date_to)). ' 23:59:59';

        $this->model = $this->model
            ->whereBetween('audit_trail.created_at', [$date_from, $date_to])
            ->select([
                'audit_trail.type',
                'audit_trail.status',
                'audit_trail.business_id',
                'audit_trail.user_id',
                'audit_trail.created_at',
                'audit_trail.updated_at'
            ])
            ->leftJoin(
                'business_detail',
                'business_detail.business_id',
                '=',
                'audit_trail.id'
            )
            ->leftJoin(
                'business_information',
                'business_information.business_id',
                '=',
                'audit_trail.id'
            )
            ->leftJoin(
                'owners_information',
                'owners_information.business_id',
                '=',
                'audit_trail.id'
            )
            ->leftJoin(
                'users',
                'audit_trail.user_id',
                '=',
                'users.id'
            );
          

            // $this->pushCriteria(new AuditTrailCriteria($filters))->applyCriteria();

            $result = $this->model->get();

            return $result;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
