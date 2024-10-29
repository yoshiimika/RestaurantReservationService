@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="input-group">
                <label for="email" class="email-input">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="error__group">
                @error('email')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="password" class="password-input">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="error__group">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="login-button">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
