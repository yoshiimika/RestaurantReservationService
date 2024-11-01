@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">
            ご予約ありがとうございます
        </h2>
        <a class="back-button" href="{{route('users.mypage')}}">
            戻る
        </a>
    </div>
</div>
@endsection