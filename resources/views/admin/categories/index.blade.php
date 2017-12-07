@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            {!! Button::primary('Nova categoria')->asLinkTo(route('admin.categories.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()
                    ->callback('Editar', function($field, $category){
                        $linkEdit = route('admin.categories.edit', ['user' => $category->id]);
                        return Button::primary(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
                    ->callback('Remover', function($field, $category){
                        $linkShow = route('admin.categories.show', ['user' => $category->id]);
                        return Button::danger(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $categories->links() !!}
    </div>

@endsection