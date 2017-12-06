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
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand(config('app.name', url('/admin/dashboard')))->inverse();
    if (Auth::check()) {
        $arrayLinks = [
            ['link' => route('admin.users.index'), 'title' => 'Usuário'],
        ];
        $menus = Navigation::links($arrayLinks);
        $logout = Navigation::links([
            [
                Auth::user()->name,
                [
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
