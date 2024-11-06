@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            店舗情報変更内容を確認
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
                {{ $area->name }}
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                ジャンル
            </div>
            <div class="shop-information__group-content">
                {{ $genre->name }}
            </div>
        </div>
        <div class="shop-information__group">
            <div class="shop-information__group-title">
                店舗画像
            </div>
            <div class="shop-information__group-content">
                <img alt="店舗画像" src="{{ $image_url }}" style="width: 150px;">
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
        <div class="button__group">
            <form action="{{ route('shop_owner.shop.edit.update', $shop->id) }}" class="shop-information-form" enctype="multipart/form-data" method="POST">
            @method('PATCH')
            @csrf
                <input name="shop_id" type="hidden" value="{{ $shop->id }}">
                <input name="name" type="hidden" value="{{ $name }}">
                <input name="area" type="hidden" value="{{ $area->id }}">
                <input name="genre" type="hidden" value="{{ $genre->id }}">
                <input name="image_url" type="hidden" value="{{ $image_url }}">
                <input name="outline" type="hidden" value="{{ $outline }}">
                <button class="confirm-button" type="submit">
                    変更する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection