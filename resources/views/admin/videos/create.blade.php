@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            @component('admin.videos.tabs-component')
            <h3>Novo vídeo</h3>
            <?php $icon = Icon::create('floppy-disk'); ?>
            {!!
                form($form->add('salve', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => $icon
                ]))
            !!}
            @endcomponent
        </div>
    </div>

@endsection