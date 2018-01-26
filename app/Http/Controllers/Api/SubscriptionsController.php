<?php

namespace CodeFlix\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Contracts\Repositories\SubscriptionRepository;

class SubscriptionsController extends Controller
{
    private $repository;

    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $subscriptions = $this->repository->with('plan')->whereHas('order', function($query){
            $query->where('user_id', \Auth::guard('api')->user()->id);
        })->all();

        return $subscriptions;
       
    }
}
