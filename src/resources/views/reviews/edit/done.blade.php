@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">
            レビューを編集しました
        </h2>
        <p>レビューの編集が完了しました。<br>ありがとうございます。</p>
        <a class="back-button" href="{{ route('users.mypage') }}">
            マイページに戻る
        </a>
    </div>
</div>
@endsection
