@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            店舗代表者編集内容を確認
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
        @if(!empty($new_password))
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                新しいパスワード
            </div>
            <div class="shop_owner-information__group-content">
                <span id="password-field" style="display: none;">
                    {{ $new_password }}
                </span>
                <span id="password-masked">
                    {{ str_repeat('●', strlen($new_password)) }}
                </span>
                <button id="toggle-password" type="button">
                    パスワード表示
                </button>
            </div>
        </div>
        @else
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                パスワード
            </div>
            <div class="shop_owner-information__group-content">
                変更なし
            </div>
        </div>
        @endif
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                店舗
            </div>
            <div class="shop_owner-information__group-content">
                {{ $shop_name }}
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('admin.edit.update', $shopOwner->id) }}" class="shop_owner-information-form" method="POST">
            @method('PATCH')
            @csrf
                <input name="name" type="hidden" value="{{ $name }}">
                <input name="email" type="hidden" value="{{ $email }}">
                <input name="shop_id" type="hidden" value="{{ $shop_id }}">
                <input name="current_password" type="hidden" value="{{ $current_password }}">
                @if(!empty($new_password))
                <input name="new_password" type="hidden" value="{{ $new_password }}">
                <input name="new_password_confirmation" type="hidden" value="{{ $new_password }}">
                @endif
                <button class="confirm-button" type="submit">
                    編集する
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