@extends('layouts.verify-email')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email">
    <div class="verify-email__card">
        <h2 class="verify-email__title">{{ __('メールアドレスの確認') }}</h2>
        <div class="verify-email__message">
            @if (session('status') == 'verification-link-sent')
                <div class="verify-email__alert verify-email__alert--success" role="alert">
                    {{ __('新しい認証リンクが登録されたメールアドレスに送信されました。') }}
                </div>
            @endif
            <p>{{ __('メールに記載されているリンクをクリックしてメールアドレスを確認してください。') }}</p>
            <p>{{ __('もしメールが届いていない場合は、下記のリンクをクリックして再度送信することができます。') }}</p>
        </div>
        <div class="verify-email__button-group">
            <form method="POST" action="{{ route('verification.send') }}" class="verify-email__form">
                @csrf
                <button type="submit" class="verify-email__button">{{ __('認証メールを再送信') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
