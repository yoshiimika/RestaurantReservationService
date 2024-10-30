@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">店舗代表者作成内容を確認</h2>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">名前</div>
            <div class="shop_owner-information__group-content">{{ $name }}</div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">メールアドレス</div>
            <div class="shop_owner-information__group-content">{{ $email }}</div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">パスワード</div>
            <div class="shop_owner-information__group-content">
                <span id="password-field" style="display: none;">{{ $password }}</span>
                <span id="password-masked">{{ str_repeat('●', strlen($password)) }}</span>
                <button type="button" id="toggle-password">パスワード表示</button>
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">店舗</div>
            <div class="shop_owner-information__group-content">{{ $shop_name }}</div>
        </div>
        <div class="button__group">
            <form action="{{ route('admin.store') }}" method="POST" class="shop_owner-information-form">
                @csrf
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="password" value="{{ $password }}">
                <input type="hidden" name="password_confirmation" value="{{ $password }}">
                <input type="hidden" name="shop_id" value="{{ $shop_id }}">
                <input type="hidden" name="role_id" value="{{ $role_id }}">
                <button type="submit" class="confirm-button">作成する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
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
