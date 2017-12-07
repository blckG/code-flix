<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Contracts\Repositories\CategoryRepository;
use CodeFlix\Forms\CategoryForm;
use CodeFlix\Models\Category;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->orderBy('id', 'DESC')->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
           'url' => route('admin.categories.store'),
           'method' => 'POST'
        ]);
        return view('admin.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(CategoryForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create($data);
        $request->session()->flash('success', 'Categoria criada com sucesso!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.update', ['category' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);
        return view('admin.categories.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(CategoryForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('success', "Categoria <b>{$data['name']}</b> editada com sucesso!");
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('success', 'Categoria removida com sucesso!');
        return redirect()->route('admin.categories.index');
    }
}
