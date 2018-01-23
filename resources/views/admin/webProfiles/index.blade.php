@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de perfis do PayPal</h3>
            {!! Button::primary('Novo perfil PayPal')->asLinkTo(route('admin.web_profiles.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($webProfiles->items())->striped()
                    ->callback('Editar', function($field, $web_profile){
                        $linkEdit = route('admin.web_profiles.edit', ['web_profile' => $web_profile->id]);
                        return Button::primary(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
                    ->callback('Remover', function($field, $web_profile){
                        $linkShow = route('admin.web_profiles.show', ['web_profile' => $web_profile->id]);
                        return Button::danger(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $webProfiles->links() !!}
    </div>

@endsection