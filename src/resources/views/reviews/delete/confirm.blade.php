@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">このレビューを削除しますか？</h2>
        <div class="review__group">
            <div class="review__group-title">評価</div>
            <div class="review__group-content">{{ $review->rating }}</div>
        </div>
        <div class="review__group">
            <div class="review__group-title">コメント</div>
            <div class="review__group-content">{{ $review->comment }}</div>
        </div>
        <div class="button__group">
            <form action="{{ route('reviews.delete.delete', $review->id) }}" method="POST" class="review-form">
                @method('DELETE')
                @csrf
                <button type="submit" class="confirm-button">削除する</button>
            </form>
            <a href="{{ route('users.mypage') }}" class="back-button">戻る</a>
        </div>
    </div>
</div>
@endsection