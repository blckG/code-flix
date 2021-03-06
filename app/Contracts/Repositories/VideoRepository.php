<?php

namespace CodeFlix\Contracts\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace CodeFlix\Contracts\Repositories;
 */
interface VideoRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function uploadThumb($id, UploadedFile $file);
    public function uploadFile($id, UploadedFile $file);
}
