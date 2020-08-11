@component('mail::message')
# Introduction

Cảm ơn <strong>{{$user->name}}</strong> vì đã đăng ký tài khoản {{$user->email}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
