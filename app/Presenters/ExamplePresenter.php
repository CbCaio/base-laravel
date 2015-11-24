<?php

namespace BaseLaravel\Presenters;

use BaseLaravel\Transformers\ExampleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExamplePresenter
 *
 * @package namespace BaseLaravel\Presenters;
 */
class ExamplePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExampleTransformer();
    }
}
