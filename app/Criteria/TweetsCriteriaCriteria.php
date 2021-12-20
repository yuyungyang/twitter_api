<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TweetsCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class TweetsCriteriaCriteria implements CriteriaInterface
{
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
        // $model = $model->where('users_uuid','=', Auth::user()->id );
        $model = $model->where('users_uuid','=', 'fd7b2976-5f64-11ec-a939-0242ac1a0003');
        return $model;
    }
}
