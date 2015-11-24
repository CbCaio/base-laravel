<?php

namespace BaseLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Example extends Model implements Transformable
{
    use TransformableTrait;

    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'total',
        'status',
    ];

    /* Not necessary because the model related Transformer is created in Transformer/ExampleTransformer
        public function transform()
        {
            return [
                'order' => $this->id,
                'items' => $this->items
            ];
        }
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'foreign_key','local_key');
    }

    public function bestFriend()
    {
        return $this->hasOne(User::class,'local_key','foreign_key');
    }

}
