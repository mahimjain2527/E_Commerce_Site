@component('mail::message')
# Verify your email

Thanks for registering! Please click the button below to verify your email.

@component('mail::button', ['url' => $url])
Verify Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent