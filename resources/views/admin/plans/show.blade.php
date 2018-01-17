@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Ver Plano</h3>
            {!! Button::primary('Ver plano')->asLinkTo(route('admin.plans.edit', ['plan' => $plan])) !!}
            {!!
                Button::danger('Remover plano')
                    ->asLinkTo(route('admin.plans.destroy', ['plan' => $plan]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.plans.destroy', 'plan' => $plan],
            'method' => 'DELETE',
            'style' => 'display:none',
            'id' => 'form-delete'
            ]);
            @endphp
            {!! form($formDelete) !!}
            <br><br>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$plan->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$plan->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$plan->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection