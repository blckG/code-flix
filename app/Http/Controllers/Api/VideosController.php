<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Contracts\Repositories\VideoRepository;
use CodeFlix\Criteria\FindPublishedAndCompletedCriteria;
use CodeFlix\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(new FindPublishedAndCompletedCriteria());
        return $this->repository
                ->scopeQuery(function ($query){
                    return $query->take(50);
                })
                ->paginate();
    }

    public function show($id)
    {
        $this->repository->pushCriteria(new FindPublishedAndCompletedCriteria());
        return $this->repository->find($id);
    }

}
