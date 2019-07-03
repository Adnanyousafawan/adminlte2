@component('mail::message')
## Hello!

You are receiving this email because we received a password reset request for your account.

Click on the below button to change password.

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.


@component('mail::button', ['url' => 'http://localhost:8000/password/reset/'.$token.'?email='.$email])
Reset Password
@endcomponent

@endcomponent
