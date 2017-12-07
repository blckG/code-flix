<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Contracts\Repositories\UserRepository;
use CodeFlix\Forms\PasswordForm;
use CodeFlix\Forms\UserForm;
use CodeFlix\Models\User;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
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
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create($data);
        $request->session()->flash('success', 'Usuário criado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = array_except($form->getFieldValues(), ['password', 'role']);
        $this->repository->update($data, $id);
        $request->session()->flash('success', 'Usuário alterado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('success', 'Usuário removido com sucesso!');
        return redirect()->route('admin.users.index');
    }

    public function changePassword()
    {
        $form = \FormBuilder::create(PasswordForm::class, [
            'url' => route('admin.users.update-password'),
            'method' => 'PUT'
        ]);
        return view('admin.users.change-password', compact('form'));
    }

    public function updatePassword()
    {
        $form = \FormBuilder::create(PasswordForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = array_only($form->getFieldValues(), ['password']);
        $this->repository->updatePassword($data, \Auth::user()->id);
        \Session::flash('success', 'Senha alterada com sucesso!');
        return redirect()->route('admin.users.index');
    }
}
