<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TweetsRepository;
use App\Entities\Tweets;
use App\Validators\TweetsValidator;

/**
 * Class TweetsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TweetsRepositoryEloquent extends BaseRepository implements TweetsRepository
{
	/**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tweets::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TweetsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
