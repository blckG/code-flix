<h3>{{config('app.name')}}</h3>
<p>Sua conta na plataforma foi criada!</p>
<p>Clique no botão abaixo para verificar a sua conta</p>
<a style="padding: 15px; background-color: #09f; color: #fff; text-decoration: none;"
        href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">Verificar
    conta</a>
<p>Obs: Não responsa este e-mail, ele é gerado automaticamente</p>

