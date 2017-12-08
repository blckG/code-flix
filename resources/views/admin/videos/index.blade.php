@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de vídeos</h3>
            {!! Button::primary('Novo vídeo')->asLinkTo(route('admin.videos.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($videos->items())->striped()
                    ->callback('Descrição', function ($field, $video){
                        return MediaObject::withContents([
                            'image' => "//placehold.it/64x64",
                            'link' => '#',
                            'heading' => $video->title,
                            'body' => $video->description
                        ]);
                    })
                    ->callback('Editar', function($field, $video){
                        $linkEdit = route('admin.videos.edit', ['user' => $video->id]);
                        return Button::primary(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
                    ->callback('Remover', function($field, $video){
                        $linkShow = route('admin.videos.show', ['user' => $video->id]);
                        return Button::danger(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $videos->links() !!}
    </div>

@endsection

@push('styles')
    <style>
        .media-body{
            width: auto;
        }
    </style>
@endpush