@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Ver usuário</h3>
            {!! Button::primary('Ver usuário')->asLinkTo(route('admin.users.edit', ['user' => $user])) !!}
            {!!
                Button::danger('Remover usuário')
                    ->asLinkTo(route('admin.users.destroy', ['user' => $user]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.users.destroy', 'user' => $user],
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
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection