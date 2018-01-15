<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);
        $password = $request->only('password');
        $this->repository->updatePassword($password, \Auth::guard('api')->user()->id);
        return response()->json(['message' => 'success']);
    }
}
