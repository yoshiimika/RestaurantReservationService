@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
@endsection

@section('content')
<div class="edit-shop_owner-form__content">
    <div class="edit-shop_owner-form__heading">
        <h2>{{ $shopOwner->name }} の情報を編集</h2>
    </div>
    <form class="form" action="{{ route('admin.update-confirm', ['shopOwner' => $shopOwner->id]) }}" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input type="text" name="name" value="{{ old('name', $shopOwner->name) }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--email">
                    <input type="email" name="email" value="{{ old('email', $shopOwner->email) }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">現在のパスワード</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--password">
                    <input type="password" name="current_password">
                </div>
                <div class="form__error">
                    @error('current_password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">新しいパスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--password">
                    <input type="password" name="new_password">
                </div>
                <div class="form__error">
                    @error('new_password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">新しいパスワード（確認）</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--password">
                    <input type="password" name="new_password_confirmation">
                </div>
                <div class="form__error">
                    @error('new_password_confirmation')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--shop">
                    <select name="shop_id">
                        <option disabled selected>選択してください</option>
                        <option value="" {{ is_null($shopOwner->shop_id) ? 'selected' : '' }}>店舗なし</option>
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}" {{ old('shop_id', $shopOwner->shop_id) == $shop->id ? 'selected' : '' }}>
                                {{ $shop->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('shop_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection