Beste, <br /><br />

Klik hier om te registreren: {!! HTML::link(route('auth.register', ['token' => $register->token]), 'registreren') !!}.<br /><br />

{{ $user->name }},<br />
{{ $user->company->name }}