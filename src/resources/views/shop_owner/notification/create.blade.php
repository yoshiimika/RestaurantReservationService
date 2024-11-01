@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notification/create.css') }}">
@endsection

@section('content')
<div class="notification__content">
    <div class="notification__heading">
        <h2 class="notification__heading-title">
            お知らせメールの送付
        </h2>
    </div>
    <form action="{{ route('shop_owner.notification.confirm') }}" class="form" method="POST">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お知らせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--content">
                    <textarea name="message_content">{{ old('message_content') }}</textarea>
                </div>
                <div class="form__error">
                    @error('message_content')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">送付先</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--user">
                @foreach ($users as $user)
                    <div class="user-checkbox">
                        <label class="checkbox-label" for="user_{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</label>
                        <input class="checkbox-input" name="user_ids[]" type="checkbox" value="{{ $user->id }}" {{ is_array(old('user_ids')) && in_array($user->id, old('user_ids')) ? 'checked' : '' }}>
                    </div>
                @endforeach
                </div>
                <div class="form__error">
                    @error('user_ids')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">
                確認画面
            </button>
        </div>
    </form>
</div>
@endsection