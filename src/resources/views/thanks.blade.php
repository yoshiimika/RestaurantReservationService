@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks-card">
        <h2>会員登録ありがとうございます</h2>
        <a href="{{route('login')}}" class="login-button">ログインする</a>
    </div>
</div>
@endsection
