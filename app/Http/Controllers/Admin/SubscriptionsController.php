<?php

namespace CodeFlix\Http\Controllers\Admin;

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
        $subscriptions = $this->repository->paginate();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
