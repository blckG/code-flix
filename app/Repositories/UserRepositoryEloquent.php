<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Contracts\Repositories\UserRepository;
use CodeFlix\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        //\UserVerification::generate($model);
        //\UserVerification::send($model, 'Sua conta foi criada');
        return $model;
    }

    public function updatePassword($data, $id)
    {
        $data['password'] = bcrypt($data['password']);
        parent::update($data, $id);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
