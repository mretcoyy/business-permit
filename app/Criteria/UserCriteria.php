<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Entities\User;
use App\Enums\UserRole;

/**
 * Class UserCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserCriteria implements CriteriaInterface
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

        if (isset($filters->user_id) && $filters->user_id != '') {
            $model->where('id', $filters->user_id);
        }

        if (isset($filters->search_keyword) && $filters->search_keyword != '') {
            $model->where('name', 'LIKE', '%'.$filters->search_keyword.'%')
                ->orWhere('contact_number', 'LIKE',  '%'.$filters->search_keyword.'%')
                ->orWhere('full_address', 'LIKE',  '%'.$filters->search_keyword.'%')
                ->orWhere('email', 'LIKE',  '%'.$filters->search_keyword.'%');
        }

        if (isset($filters->role) && $filters->role != '') {
            $model->where('role', $filters->role);
        }

        return $model;
    }
}
