<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand(config('app.name', url('/admin/dashboard')))->inverse();
    if (Auth::check()) {
        $arrayLinks = [
            ['link' => route('admin.users.index'), 'title' => 'Usuário'],
            ['link' => route('admin.categories.index'), 'title' => 'Categorias'],
            ['link' => route('admin.series.index'), 'title' => 'Séries'],
            ['link' => route('admin.videos.index'), 'title' => 'Vídeos'],
            [
                'Vendas',
                [
                    ['link' => route('admin.plans.index'), 'title' => 'Planos'],
                    ['link' => route('admin.web_profiles.index'), 'title' => 'Perfis PayPal'],
                    ['link' => route('admin.subscriptions.index'), 'title' => 'Adesões']
                ]
            ]
        ];
        $menus = Navigation::links($arrayLinks);
        $logout = Navigation::links([
            [
                Auth::user()->name,
                [
                    [
                        'link' => route('admin.users.change-password'),
                        'title' => 'Redefinir senha'
                    ],

                    [
                        'link' => route('admin.logout'),
                        'title' => 'Logout',
                        'linkAttributes' => [
                            'onclick' => "event.preventDefault(); document.getElementById(\"form-logout\").submit();"
                        ]
                    ]
                ]
            ]
        ])->right();
        $navbar->withContent($menus)->withContent($logout);
    }
    ?>
    {!! $navbar !!}
    <?php
    $formLogout = FormBuilder::plain([
        'route' => ['admin.logout'],
        'method' => 'POST',
        'style' => 'display:none',
        'id' => 'form-logout'
    ]);
    ?>
    {!! form($formLogout) !!}

    @if(Session::has('success'))
        <div class="container">
            {!! Alert::success(Session::get('success'))->close() !!}
        </div>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
