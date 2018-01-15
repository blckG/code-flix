<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Laravel\Socialite\Two\User;

class RegisterUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $authorization = $request->header('Authorization');
        $accessToken = str_replace('Bearer ', '', $authorization);
        $facebook = \Socialite::driver('facebook');
        /** @var $userSocial User */
        $userSocial = $facebook->userFromToken($accessToken);
        dd($userSocial);
    }
}
