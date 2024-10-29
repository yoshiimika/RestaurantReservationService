@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">店舗作成内容を確認</h2>
        <div class="shop-information__group">
            <div class="shop-information__group-title">店舗名</div>
            <div class="shop-information__group-content">{{ $name }}</div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">エリア</div>
            <div class="shop-information__group-content">{{ $area_name }}</div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">ジャンル</div>
            <div class="shop-information__group-content">{{ $genre_name }}</div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">店舗画像</div>
            <div class="shop-information__group-content">
                    <img src="{{ asset($image) }}" alt="店舗画像" style="width: 150px;">
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">店舗詳細</div>
            <div class="shop-information__group-content">{{ $outline }}</div>
        </div>
        <div class="button-group">
            <form action="{{ route('shop_owner.shop.store') }}" method="POST" class="shop-information-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="area" value="{{ $area }}">
                <input type="hidden" name="genre" value="{{ $genre }}">
                <input type="hidden" name="image" value="{{ $image }}">
                <input type="hidden" name="outline" value="{{ $outline }}">
                <button type="submit" class="confirm-button">作成する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection