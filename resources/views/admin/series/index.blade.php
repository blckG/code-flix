@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de séries</h3>
            {!! Button::primary('Nova série')->asLinkTo(route('admin.series.create')) !!}
        </div>
        <div class="row">
            {!!
            Table::withContents($series->items())->striped()
                    ->callback('Descrição', function ($field, $serie){
                        return MediaObject::withContents([
                            'image' => $serie->thumb_small_asset,
                            'link' => '#',
                            'heading' => $serie->title,
                            'body' => $serie->description
                        ]);
                    })
                    ->callback('Editar', function($field, $serie){
                        $linkEdit = route('admin.series.edit', ['serie' => $serie->id]);
                        return Button::primary(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
                    ->callback('Remover', function($field, $serie){
                        $linkShow = route('admin.series.show', ['serie' => $serie->id]);
                        return Button::danger(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $series->links() !!}
    </div>

@endsection

@push('styles')

@endpush