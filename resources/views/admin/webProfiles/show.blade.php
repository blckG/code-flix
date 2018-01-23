@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Ver perfil PayPal</h3>
            {!! Button::primary('ver perfil PayPal')->asLinkTo(route('admin.web_profiles.edit', ['web_profile' => $web_profile])) !!}
            {!!
                Button::danger('Remover plano')
                    ->asLinkTo(route('admin.web_profiles.destroy', ['web_profile' => $web_profile]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.web_profiles.destroy', 'web_profile' => $web_profile],
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
                    <td>{{$web_profile->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$web_profile->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Logo Url</th>
                    <td>{!! \BootstrapperImage::thumbnail($web_profile->logo_url, 'thumbnail') !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection