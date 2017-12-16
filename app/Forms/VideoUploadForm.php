<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoUploadForm extends Form
{
    public function buildForm()
    {
        $this->add('thumb', 'file', [
           'label' => 'Thumbnail',
           'rules' => 'image|max:1024'
        ])
        ->add('video', 'file', [
            'label' => 'Arquivo de vídeo',
            'rules' => 'mimetypes:video/mp4'
        ])
        ->add('duration', 'text', [
            'label' => 'Duração (minutos)',
            'rules' => 'required|integer|min:1'
        ]);
    }
}
