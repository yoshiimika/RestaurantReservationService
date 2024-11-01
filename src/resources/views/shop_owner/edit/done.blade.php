@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">
            店舗情報を変更しました
        </h2>
        <a class="back-button" href="{{ route('shop_owner.reservations') }}">
            予約一覧画面に戻る
        </a>
    </div>
</div>
@endsection
