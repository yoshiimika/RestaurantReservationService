@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="registration-container">
    <div class="registration-card">
        <h2 class="registration-title">Registration</h2>
        <form method="POST" action="{{route('register')}}">
            @csrf
            <div class="input-group">
                <label for="name" class="name-input">Username</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="error__group">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
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
                <button type="submit" class="register-button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
