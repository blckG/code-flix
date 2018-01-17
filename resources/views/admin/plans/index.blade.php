@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de planos</h3>
            {!! Button::primary('Novo plano')->asLinkTo(route('admin.plans.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($plans->items())->striped()
                    ->callback('Editar', function($field, $plan){
                        $linkEdit = route('admin.plans.edit', ['plan' => $plan->id]);
                        return Button::primary(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
                    ->callback('Remover', function($field, $plan){
                        $linkShow = route('admin.plans.show', ['plan' => $plan->id]);
                        return Button::danger(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $plans->links() !!}
    </div>

@endsection