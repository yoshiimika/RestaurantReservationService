@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notification/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">お知らせメールを送信しました</h2>
        <a href="{{ route('shop_owner.reservations') }}" class="back-button">予約一覧画面に戻る</a>
    </div>
</div>
@endsection
