@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">
            Login
        </h2>
        <form action="{{route('login')}}" method="POST">
        @csrf
            <div class="input-group">
                <label class="email-input" for="email">Email</label>
                <input id="email" name="email" type="email">
            </div>
            <div class="error__group">
                @error('email')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label class="password-input" for="password">Password</label>
                <input id="password" name="password" type="password">
            </div>
            <div class="error__group">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="button-group">
                <button class="login-button" type="submit">
                    ログイン
                </button>
            </div>
        </form>
    </div>
</div>
@endsection