@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">予約をキャンセルしました</h2>
        <p>予約のキャンセルが完了しました。<br>
            またのご利用をお待ちしております。</p>
        <a href="{{ route('users.mypage') }}" class="back-button">マイページに戻る</a>
    </div>
</div>
@endsection
