@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks-card">
        <h2 class="thanks-title">
            会員登録ありがとうございます
        </h2>
        <a class="login-button" href="{{route('login')}}">
            ログインする
        </a>
    </div>
</div>
@endsection