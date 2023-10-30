<x-mail::message>
# {{$name}}

تم حجز موعد لك في تاريخ {{$appoitment}}<br>
مع الدكتور   Dr : {{$doctor}}



Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
