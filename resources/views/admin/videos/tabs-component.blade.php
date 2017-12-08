<?php
 $tabs = [
     [
        'title' => 'Informações',
        'link' => '',
     ],
     [
         'title' => 'Séries e categorias',
         'link' => '',
     ],
     [
         'title' => 'Vídeo e thumbnail',
         'link' => '',
     ]
 ];
 ?>
<h3>Gerenciar vídeo</h3>
<div class="text-right">{!! Button::primary('Listar vídeos')->asLinkTo(route('admin.videos.index')) !!}</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {{$slot}}
</div>
