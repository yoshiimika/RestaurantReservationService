@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/create.css') }}">
@endsection

@section('content')
<div class="create-shop-form__content">
    <div class="create-shop-form__heading">
        <h2 class="create-shop-form__heading-title">
            店舗の作成
        </h2>
    </div>
    <form action="{{ route('shop_owner.shop.confirm') }}" class="form" enctype="multipart/form-data" method="POST">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗名</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input name="name" type="text" value="{{ old('name') }}">
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
                        <option disabled selected>選択してください</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area') == $area->id ? 'selected' : '' }}>
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
                        <option disabled selected>選択してください</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'selected' : '' }}>
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
                @if(session('shop_data.image'))
                    <div class="shop-image-preview">
                        <p>アップロードされた画像:</p>
                        <img alt="店舗画像" src="{{ asset(session('shop_data.image')) }}" style="width: 150px;">
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
                    <textarea name="outline">{{ old('outline') }}</textarea>
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