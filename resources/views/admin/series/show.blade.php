@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Série: {{$serie->title}}</h3>
            {!! Button::primary('Ver série')->asLinkTo(route('admin.series.edit', ['category' => $serie])) !!}
            {!!
                Button::danger('Remover série')
                    ->asLinkTo(route('admin.series.destroy', ['category' => $serie]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.series.destroy', 'category' => $serie],
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
                    <th scope="row">Thumb</th>
                    <td><img src="{{$serie->thumb_asset}}" width="560" height="360"></td>
                </tr>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$serie->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$serie->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$serie->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection