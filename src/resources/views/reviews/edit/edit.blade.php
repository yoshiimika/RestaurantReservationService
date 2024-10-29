@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reviews/edit.css') }}">
@endsection

@section('content')
<div class="review-container">
    <div class="shop-info">
        <div class="shop-header">
            <a href="{{ route('users.mypage') }}" class="back-button"><</a>
            <h1 class="shop-name">{{ $review->shop->name }}</h1>
        </div>
        <img src="{{ asset($review->shop->image_url) }}" alt="{{ $review->shop->name }}" class="shop-image">
        <p class="shop-tags">#{{ $review->shop->area->name }} #{{ $review->shop->genre->name }}</p>
        <p class="shop-description">{{ $review->shop->outline }}</p>
    </div>
    <div class="review-edit">
        <h2>{{ $review->shop->name }} のレビューを編集する</h2>
        <form action="{{ route('reviews.edit.confirm', $review->id) }}" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">評価(1-5)</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--rating">
                        <select name="rating">
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5</option>
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
                        <textarea name="comment">{{ old('comment', $review->comment) }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="edit-button">編集内容を確認する</button>
        </form>
    </div>
</div>
@endsection
