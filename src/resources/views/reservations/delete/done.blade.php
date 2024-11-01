@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">
            予約をキャンセルしました
        </h2>
        <p>キャンセルが完了しました。<br>又のご利用をお待ちしています。</p>
        <a class="back-button" href="{{ route('users.mypage') }}">
            マイページに戻る
        </a>
    </div>
</div>
@endsection
