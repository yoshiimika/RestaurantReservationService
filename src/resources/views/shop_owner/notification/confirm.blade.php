@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notification/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            送信内容の確認
        </h2>
        <div class="notification__group">
            <div class="notification__group-title">
                お知らせ内容
            </div>
            <div class="notification__group-content">
                {{ $messageContent }}
            </div>
        </div>
        <div class="notification__group">
            <div class="notification__group-title">
                送信先
            </div>
            <div class="notification__group-content">
                <ul>
                @foreach ($sentUsers as $user)
                    <li>{{ $user->name }} ({{ $user->email }})</li>
                @endforeach
                </ul>
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('shop_owner.notification.send') }}" class="notification-form" method="POST">
            @csrf
                <input name="message_content" type="hidden" value="{{ $messageContent }}">
                @foreach ($sentUsers as $user)
                    <input name="user_ids[]" type="hidden" value="{{ $user->id }}">
                @endforeach
                <button class="confirm-button" type="submit">
                    送信する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection