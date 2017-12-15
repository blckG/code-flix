<?php


namespace CodeFlix\Media;


use Illuminate\Http\UploadedFile;

trait VideoUploads
{

    public function uploadFile($id, UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model, $file, 'file');
        if($name) {
            $this->deleteFilesOld($model);
            $model->file = $name;
            $model->save();
        }
        return $model;
    }

    protected function deleteFilesOld($model)
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        if($storage->exists($model->file_relative)) {
            $storage->delete($model->file_relative);
        }
    }
}