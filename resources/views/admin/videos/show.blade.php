@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Série: {{$video->title}}</h3>
            {!! Button::primary('Ver vídeo')->asLinkTo(route('admin.series.edit', ['category' => $video])) !!}
            {!!
                Button::danger('Remover vídeo')
                    ->asLinkTo(route('admin.videos.destroy', ['video' => $video]))
                    ->addAttributes(['onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"]);
            !!}
            @php
            $formDelete = FormBuilder::plain([
            'route' => ['admin.videos.destroy', 'video' => $video],
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
                    <td><img src="{{$video->thumb_asset}}" width="560" height="360"></td>
                </tr>
                <tr>
                    <th scope="row">Download</th>
                    <td><a href="{{$video->file_asset}}">Download</a></td>
                </tr>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$video->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$video->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$video->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection