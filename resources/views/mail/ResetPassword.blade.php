@component('mail::message')
# Hello,

Resetting your password is easy. Just press the button below and follow the instructions. We'll have you up and running in no time. If you are having trouble clicking the  'Reset Password' button, copy and paste the URL below into your web browser.
{{$Whitelabel->domain}}/login/reset/{{$Token}}

@component('mail::button', ['url' => $Whitelabel->domain."/login/reset/".$Token])
Reset Password
@endcomponent

Thank you for using {{$Whitelabel->brand}},<br>
{{$Whitelabel->brand}} Team
@endcomponent
