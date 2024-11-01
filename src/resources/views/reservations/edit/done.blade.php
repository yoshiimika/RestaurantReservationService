@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">
            予約内容を変更しました
        </h2>
        <p>予約内容の変更が完了しました。<br>ありがとうございます。</p>
        <a class="back-button" href="{{ route('users.mypage') }}">
            マイページに戻る
        </a>
    </div>
</div>
@endsection
