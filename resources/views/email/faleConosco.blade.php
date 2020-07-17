@component('mail::message')
Mensagem de contato pelo site!

Assunto:<h3>{{$assunto}}</h3>

<br />

Nome do contato: <p><strong>{{$name}}</strong></p>

<br />

Email do contato: <p><strong>{{$email}}</strong></p>

<br />

Telefone do contato: <p><strong>{{$telefone}}</strong></p>

<br />

Mensagem: <br />
{{$mensagem}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
