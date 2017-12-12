<?php

namespace CodeFlix\Contracts\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace CodeFlix\Contracts\Repositories;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb($id, UploadedFile $file);
}
