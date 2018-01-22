<?php

namespace CodeFlix\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Contracts\Repositories\PlanRepository;

class PlansController extends Controller
{

	private $repository;

	public function __construct(PlanRepository $repository)
	{
		$this->repository = $repository;
	}

	public function index()
	{
		return $this->repository->all();
	}
}
