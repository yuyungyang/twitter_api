<?php

namespace App\Presenters;

use App\Transformers\TweetsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TweetsPresenter.
 *
 * @package namespace App\Presenters;
 */
class TweetsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TweetsTransformer();
    }
}
