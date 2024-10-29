@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('content')
<div class="create-admin-form__content">
    <div class="create-admin-form__heading">
        <h2>店舗代表者の作成</h2>
    </div>
    <form class="form" action="{{ route('admin.confirm') }}" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input type="text" name="name" value="{{ old('name') }}">
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
                    <input type="email" name="email" value="{{ old('email') }}">
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
                <span class="form__label--item">パスワード</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--password">
                    <input type="password" name="password">
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード確認</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--password_confirmation">
                    <input type="password" name="password_confirmation">
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
                        <option value="" disabled {{ old('shop_id') === null ? 'selected' : '' }}>選択してください</option>
                        <option value="" {{ old('shop_id') === "" ? 'selected' : '' }}>店舗なし</option>
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
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