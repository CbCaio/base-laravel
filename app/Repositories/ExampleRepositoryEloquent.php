<?php

namespace BaseLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BaseLaravel\Repositories\ExampleRepository;
use BaseLaravel\Models\Example;

/**
 * Class ExampleRepositoryEloquent
 * @package namespace BaseLaravel\Repositories;
 */
class ExampleRepositoryEloquent extends BaseRepository implements ExampleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Example::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
