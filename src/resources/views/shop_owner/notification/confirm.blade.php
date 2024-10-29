@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notification/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">送信内容を確認</h2>
        <div class="notification__group">
            <div class="notification__group-title">お知らせ内容</div>
            <div class="notification__group-content">{{ $messageContent }}</div>
        </div>
        <div class="notification__group">
            <div class="notification__group-title">送信先</div>
            <div class="notification__group-content">
                <ul>
                    @foreach ($sentUsers as $user)
                        <li>{{ $user->name }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('shop_owner.notification.send') }}" method="POST" class="notification-form">
                @csrf
                    <input type="hidden" name="message_content" value="{{ $messageContent }}">
                    @foreach ($sentUsers as $user)
                        <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    @endforeach
                <button type="submit" class="confirm-button">送信する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection