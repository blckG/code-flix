<?php

namespace CodeFlix\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace CodeFlix\Contracts\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function updatePassword($password, $id);
}
