<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Contracts\Repositories\PlanRepository;
use CodeFlix\Forms\PlanForm;
use CodeFlix\Models\Plan;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $plans = $this->repository->orderBy('id', 'DESC')->paginate();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    public function create()
    {
        $form = \FormBuilder::create(PlanForm::class, [
            'url' => route('admin.plans.store'),
            'method' => 'POST'
        ]);
        return view('admin.plans.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(PlanForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create($data);
        $request->session()->flash('success', 'Plano criado com sucesso!');
        return redirect()->route('admin.plans.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $form = \FormBuilder::create(PlanForm::class, [
            'url' => route('admin.plans.update', ['plan' => $plan->id]),
            'method' => 'PUT',
            'model' => $plan
        ]);
        return view('admin.plans.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(PlanForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('success', "Plano <b>{$data['name']}</b> editado com sucesso!");
        return redirect()->route('admin.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('success', 'Plano removido com sucesso!');
        return redirect()->route('admin.plans.index');
    }
}
