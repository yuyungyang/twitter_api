<?php

namespace App\Entities;
// namespace App\Traits;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Tweets.
 *
 * @package namespace App\Entities;
 */
class Tweets extends Model implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'users_uuid', 'is_retweet', 'tweet_text', 'modified_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
