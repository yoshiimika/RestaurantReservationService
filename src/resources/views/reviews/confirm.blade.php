@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            {{ $shop->name }}のレビュー投稿内容を確認
        </h2>
        <div class="review__group">
            <div class="review__group-title">
                評価
            </div>
            <div class="review__group-content">
                {{ $rating }}
            </div>
        </div>
        <div class="review__group">
            <div class="review__group-title">
                コメント
            </div>
            <div class="review__group-content">
                {{ $comment }}
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('reviews.store', $shop->id) }}" class="review-form" method="POST">
            @csrf
                <input name="user_id" type="hidden" value="{{ $user_id }}">
                <input name="shop_id" type="hidden" value="{{ $shop->id }}">
                <input name="rating" type="hidden" value="{{ $rating }}">
                <input name="comment" type="hidden" value="{{ $comment }}">
                <button class="confirm-button" type="submit">
                    レビューを投稿する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection