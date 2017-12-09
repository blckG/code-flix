<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Contracts\Repositories\VideoRepository;
use CodeFlix\Forms\VideoRelationForm;
use CodeFlix\Models\Video;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class VideoRelationsController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Video $video)
    {
        $form = \FormBuilder::create(VideoRelationForm::class, [
            'url' => route('admin.videos.relations.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);
        return view('admin.videos.relation', compact('form'));
    }

    public function store(Request $request, $id)
    {
        $form = \FormBuilder::create(VideoRelationForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('success', 'Vídeo alterado com sucesso!');
        return redirect()->route('admin.videos.relations.create', ['video' => $id]);
    }
}
