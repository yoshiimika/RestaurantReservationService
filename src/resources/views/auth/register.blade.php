@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="registration-container">
    <div class="registration-card">
        <h2 class="registration-title">
            Registration
        </h2>
        <form action="{{route('register')}}" method="POST">
        @csrf
            <div class="input-group">
                <label class="name-input" for="name">Username</label>
                <input id="name" name="name" type="text">
            </div>
            <div class="error__group">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
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
                <button class="register-button" type="submit">
                    登録
                </button>
            </div>
        </form>
    </div>
</div>
@endsection