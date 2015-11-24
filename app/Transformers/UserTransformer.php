<?php

namespace BaseLaravel\Transformers;

use League\Fractal\TransformerAbstract;
use BaseLaravel\Models\User;

/**
 * Class UserTransformer
 * @package namespace BaseLaravel\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /*
     *
    * protected $defaultIncludes = [];
    * protected $availableIncludes = ['example'];
    */

        /**
     * Transform the \User entity
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
