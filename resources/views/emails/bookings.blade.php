<x-mail::message>
@component('mail::message')
# Reserva Confirmada

Hola! {{ $customer_name }}

Tu reserva ha sido confirmada exitosamente.

A continuacion te dejamos los detalles de la misma:
- Nombre del tour: {{ $tour }}
- Nombre del hotel: {{ $hotel }}
- Fecha de la reserva: {{ $date }}
- Cantidad de personas: {{ $peope }}

Gracias por confiar en nuestros servicios. Esperamos poder brindarle lo mejor y que disfrutes tu estadia.

Saludos!,<br>
{{ config('app.name') }}
</x-mail::message>
