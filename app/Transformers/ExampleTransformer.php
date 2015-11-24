<?php

namespace BaseLaravel\Transformers;

use League\Fractal\TransformerAbstract;
use BaseLaravel\Models\Example;

/**
 * Class ExampleTransformer
 * @package namespace BaseLaravel\Transformers;
 */
class ExampleTransformer extends TransformerAbstract
{
    /*
    *
    * protected $defaultIncludes = ['newProperty'];
    * protected $availableIncludes = [];
    */

    /**
     * Transform the \Example entity
     * @param Example $model
     *
     * @return array
     */
    public function transform(Example $model)
    {
        return [
            'id'         => (int) $model->id,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }


   public function includeNewProperty(Example $model)
   {
       if (!$model->user)
           return null;
       return $this->item($model->user, new UserTransformer());
   }
}
