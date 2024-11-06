@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            店舗作成内容の確認
        </h2>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                店舗名
            </div>
            <div class="shop-information__group-content">
                {{ $name }}
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                エリア
            </div>
            <div class="shop-information__group-content">
                {{ $area_name }}
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                ジャンル
            </div>
            <div class="shop-information__group-content">
                {{ $genre_name }}
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                店舗画像
            </div>
            <div class="shop-information__group-content">
                    <img alt="店舗画像" src="{{ $image }}" style="width: 150px;">
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                店舗詳細
            </div>
            <div class="shop-information__group-content">
                {{ $outline }}
            </div>
        </div>
        <div class="button-group">
            <form action="{{ route('shop_owner.shop.store') }}" class="shop-information-form" enctype="multipart/form-data" method="POST">
            @csrf
                <input name="name" type="hidden" value="{{ $name }}">
                <input name="area" type="hidden" value="{{ $area }}">
                <input name="genre" type="hidden" value="{{ $genre }}">
                <input name="image" type="hidden" value="{{ $image }}">
                <input name="outline" type="hidden" value="{{ $outline }}">
                <button class="confirm-button" type="submit">
                    作成する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection