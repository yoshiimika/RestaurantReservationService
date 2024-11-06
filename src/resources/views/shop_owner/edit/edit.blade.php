@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/edit.css') }}">
@endsection

@section('content')
<div class="edit-shop-form__content">
    <div class="edit-shop-form__heading">
        <h2 class="edit-shop-form__heading-title">
            店舗情報の編集
        </h2>
    </div>
    <form action="{{ route('shop_owner.shop.edit.confirm', ['shop' => $shop->id]) }}" class="form" enctype="multipart/form-data" method="POST">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗名</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input name="name" type="text" value="{{ old('name', $shop->name) }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">エリア</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--area">
                    <select name="area">
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ old('area', $shop->area->id) == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('area')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ジャンル</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--genre">
                    <select name="genre">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre', $shop->genre->id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('genre')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗画像</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--image">
                    <input name="shop_image" type="file">
                </div>
                @if(session('shop_update_image'))
                    <div class="shop-image-preview">
                        <p>アップロードされた画像:</p>
                        <img alt="店舗画像" src="{{ session('shop_update_image') }}" style="width: 150px;">
                    </div>
                @elseif(isset($shop) && $shop->image_url)
                    <div class="shop-image-preview">
                        <p>現在の店舗画像:</p>
                        <img alt="店舗画像" src="{{ $shop->image_url }}" style="width: 150px;">
                    </div>
                @endif
                <div class="form__error">
                    @error('shop_image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗説明</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="outline">{{ old('outline', $shop->outline) }}</textarea>
                </div>
                <div class="form__error">
                    @error('outline')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">
                確認画面
            </button>
        </div>
    </form>
</div>
@endsection