@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">店舗代表者編集内容を確認</h2>
        <div class="shop_owner-information-summary">
            <p class="shop_owner-information-item">名前: {{ $name }}</p>
            <p class="shop_owner-information-item">メールアドレス: {{ $email }}</p>
            @if(!empty($new_password))
            <p class="shop_owner-information-item">新しいパスワード:
                <span id="password-field" style="display: none;">{{ $new_password }}</span>
                <span id="password-masked">{{ str_repeat('●', strlen($new_password)) }}</span>
                <button type="button" id="toggle-password">パスワードを表示する</button>
            </p>
            @else
            <p class="shop_owner-information-item">パスワード:変更なし</p>
            @endif
            <p class="shop_owner-information-item">店舗: {{ $shop_name }}</p>
        </div>
        <div class="button-group">
            <form action="{{ route('admin.update', $shopOwner->id) }}" method="POST" class="shop_owner-information-form">
                @method('PATCH')
                @csrf
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="shop_id" value="{{ $shop_id }}">
                <input type="hidden" name="current_password" value="{{ $current_password }}">
                @if(!empty($new_password))
                <input type="hidden" name="new_password" value="{{ $new_password }}">
                <input type="hidden" name="new_password_confirmation" value="{{ $new_password }}">
                @endif
                <button type="submit" class="confirm-button">編集する</button>
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
