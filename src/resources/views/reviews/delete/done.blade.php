@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">レビューを削除しました</h2>
        <a href="{{ route('users.mypage') }}" class="back-button">マイページに戻る</a>
    </div>
</div>
@endsection
