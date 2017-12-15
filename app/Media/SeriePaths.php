<?php


namespace CodeFlix\Media;


trait SeriePaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute()
    {
        return "series/{$this->id}";
    }

    public function getThumbAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.series.thumb-asset', ['serie' => $this->id]) :
            $this->thumb_path;
    }

    public function getThumbSmallAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.series.thumb-small-asset', ['serie' => $this->id]) :
            $this->thumb_small_path;
    }

    public function getThumbDefaultAttribute()
    {
        return env('SERIE_NO_THUMB');
    }
}