<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Tweets;

/**
 * Class TweetsTransformer.
 *
 * @package namespace App\Transformers;
 */
class TweetsTransformer extends TransformerAbstract
{
    /**
     * Transform the Tweets entity.
     *
     * @param \App\Entities\Tweets $model
     *
     * @return array
     */
    public function transform(Tweets $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
