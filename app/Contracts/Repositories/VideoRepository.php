<?php

namespace CodeFlix\Contracts\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace CodeFlix\Contracts\Repositories;
 */
interface VideoRepository extends RepositoryInterface
{
    public function uploadThumb($id, UploadedFile $file);
}
