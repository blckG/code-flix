<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Contracts\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }
}
