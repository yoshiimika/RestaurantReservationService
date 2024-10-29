@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reviews/create.css') }}">
@endsection

@section('content')
<div class="review-container">
    <div class="shop-info">
        <div class="shop-header">
            <a href="{{ route('users.mypage') }}" class="back-button"><</a>
            <h1 class="shop-name">{{ $shop->name }}</h1>
        </div>
        <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->name }}" class="shop-image">
        <p class="shop-tags">#{{ $shop->area->name }} #{{ $shop->genre->name }}</p>
        <p class="shop-description">{{ $shop->outline }}</p>
    </div>
    <div class="review-create">
        <h2>{{ $shop->name }}にレビューを投稿する</h2>
        <form action="{{ route('reviews.confirm', $shop->id) }}" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">評価(1-5)</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--rating">
                        <select name="rating">
                            <option disabled selected>選択してください</option>
                            <option value="1" {{ old('rating', session('rating')) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('rating', session('rating')) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('rating', session('rating')) == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('rating', session('rating')) == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('rating', session('rating')) == 5 ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form__error">
                        @error('rating')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">コメント</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--comment">
                        <textarea name="comment">{{ old('comment') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="create-button">投稿内容を確認する</button>
        </form>
    </div>
</div>
@endsection
