@component('mail::message')
    # Hello Mr. {{ $user_name }}

    We hope this email finds you well.

    We would like to inform you has scheduled an appointment with you on
    {{ $appoint_date }} at {{ $appoint_time }} with Doctor {{ $doctor_name }}.


    Thank you for your attention to this matter.

    Best regards,

    {{ config('app.name') }}
@endcomponent
