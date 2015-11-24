<?php

namespace BaseLaravel\Repositories;

use BaseLaravel\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use BaseLaravel\Repositories\UserRepository;
use BaseLaravel\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace BaseLaravel\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    public function presenter()
    {
        return UserPresenter::class;
    }

    public function lists()
    {
        return $this->model->lists('name','id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
