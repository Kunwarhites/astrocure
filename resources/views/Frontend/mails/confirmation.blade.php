@component('mail::message')
    # Registration Confirmation

    Dear {{ $user->name }},

    Thank you for registering with our service. Your registration details are as follows:

    - Registration ID: {{ $user->registration_id }}
    - Email ID: {{ $user->email }}
    - Password: {{ $password }}

    Welcome to our platform!

    @component('mail::button', ['url' => 'https://astrocure.gritl.in/'])
        Visit our website
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
