@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">店舗の作成が完了しました</h2>
        <p class="done-shop-name">店舗名: {{ session('shopName') }}</p>
        <a href="{{route('shop_owner.reservations')}}" class="back-button">予約一覧画面に戻る</a>
    </div>
</div>
@endsection
