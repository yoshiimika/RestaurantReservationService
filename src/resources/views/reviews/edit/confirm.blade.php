@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">{{ $review->shop->name }}のレビュー編集内容を確認</h2>
        <div class="review__group">
            <div class="review__group-title">評価</div>
            <div class="review__group-content">{{ $rating }}</div>
        </div>
        <div class="review__group">
            <div class="review__group-title">コメント</div>
            <div class="review__group-content">{{ $comment }}</div>
        </div>
        <div class="button__group">
            <form action="{{ route('reviews.edit.update', $review->id) }}" method="POST" class="review-form">
                @method('PATCH')
                @csrf
                <input type="hidden" name="rating" value="{{ $rating }}">
                <input type="hidden" name="comment" value="{{ $comment }}">
                <button type="submit" class="confirm-button">編集する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection
