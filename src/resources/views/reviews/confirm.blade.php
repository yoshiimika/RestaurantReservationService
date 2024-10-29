@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">{{ $shop->name }}のレビュー投稿内容を確認</h2>
        <div class="review__group">
            <div class="review__group-title">評価</div>
            <div class="review__group-content">{{ $rating }}</div>
        </div>
        <div class="review__group">
            <div class="review__group-title">コメント</div>
            <div class="review__group-content">{{ $comment }}</div>
        </div>
        <div class="button__group">
            <form action="{{ route('reviews.store', $shop->id) }}" method="POST" class="review-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="rating" value="{{ $rating }}">
                <input type="hidden" name="comment" value="{{ $comment }}">
                <button type="submit" class="confirm-button">レビューを投稿する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection