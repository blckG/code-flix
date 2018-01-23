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

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
