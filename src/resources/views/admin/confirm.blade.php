@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            代表者作成内容の確認
        </h2>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                名前
            </div>
            <div class="shop_owner-information__group-content">
                {{ $name }}
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                メールアドレス
            </div>
            <div class="shop_owner-information__group-content">
                {{ $email }}
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                パスワード
            </div>
            <div class="shop_owner-information__group-content">
                <span id="password-field" style="display: none;">
                    {{ $password }}
                </span>
                <span id="password-masked">
                    {{ str_repeat('●', strlen($password)) }}
                </span>
                <button id="toggle-password" type="button">
                    パスワード表示
                </button>
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                店舗
            </div>
            <div class="shop_owner-information__group-content">
                {{ $shop_name }}
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('admin.store') }}" class="shop_owner-information-form" method="POST">
            @csrf
                <input name="name" type="hidden" value="{{ $name }}">
                <input name="email" type="hidden" value="{{ $email }}">
                <input name="password" type="hidden" value="{{ $password }}">
                <input name="password_confirmation" type="hidden" value="{{ $password }}">
                <input name="shop_id" type="hidden" value="{{ $shop_id }}">
                <input name="role_id" type="hidden" value="{{ $role_id }}">
                <button class="confirm-button" type="submit">
                    作成する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password-field');
        const passwordMasked = document.getElementById('password-masked');
        const toggleButton = document.getElementById('toggle-password');

        toggleButton.addEventListener('mousedown', function() {
            passwordField.style.display = 'inline';
            passwordMasked.style.display = 'none';
        });

        toggleButton.addEventListener('mouseup', function() {
            passwordField.style.display = 'none';
            passwordMasked.style.display = 'inline';
        });

        toggleButton.addEventListener('mouseleave', function() {
            passwordField.style.display = 'none';
            passwordMasked.style.display = 'inline';
        });
    });
</script>
@endsection