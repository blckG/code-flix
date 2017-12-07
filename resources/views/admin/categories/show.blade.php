@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Categoria: {{$category->name}}</h3>
            {!! Button::primary('Ver categoria')->asLinkTo(route('admin.categories.edit', ['category' => $category])) !!}
            {!!
                Button::danger('Remover categoria')
                    ->asLinkTo(route('admin.categories.destroy', ['category' => $category]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.categories.destroy', 'category' => $category],
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
                    <td>{{$category->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$category->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection