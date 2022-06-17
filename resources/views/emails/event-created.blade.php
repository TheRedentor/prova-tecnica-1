@component('mail::message')
# Pedido enviado al correo electrónico

Fecha: {{ $event->fecha }}<br>
Productos: {{ $event->producto }} x{{ $event->numero }}<br>
Precio: {{ $event->precio }}€

@component('mail::button', ['url' => route('calendario')])
¡Entendido!
@endcomponent

Gracias,<br>
{{ auth()->user()->name }}
@endcomponent
