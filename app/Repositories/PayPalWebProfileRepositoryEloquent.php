<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Contracts\Repositories\PayPalWebProfileRepository;
use CodeFlix\Models\PayPalWebProfile;
use CodeFlix\Validators\PayPalWebProfileValidator;

/**
 * Class PayPalWebProfileRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class PayPalWebProfileRepositoryEloquent extends BaseRepository implements PayPalWebProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PayPalWebProfile::class;
    }
    
    public function create(array $attributes)
    {
        $attributes['code'] = 'processing';
        \DB::beginTransaction();
        try {
            $model = parent::create($attributes);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        \DB::commit();
        return $model;
    }

    public function update(array $attributes, $id)
    {
        \DB::beginTransaction();
        try {
            $model = parent::update($attributes, $id);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        \DB::commit();
        return $model;
    }

    public function delete($id)
    {
        \DB::beginTransaction();
        try {
            $result = parent::delete($id);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        \DB::commit();
        return $result;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
