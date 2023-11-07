<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Entities\User;

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
            $model->where('user.id', $filters->user_id);
        }

        if (isset($fitlters->search_keyword) && $filters->search_keyword != '') {
            $model->where('user.name', 'LIKE', '%'.$filters->search_keyword.'%')
            ->where('user.contact_number', 'LIKE',  '%'.$filters->search_keyword.'%')
            ->where('user.full_address', 'LIKE',  '%'.$filters->search_keyword.'%')
            ->where('user.email', 'LIKE',  '%'.$filters->search_keyword.'%');
        }

        return $model;
    }
}
