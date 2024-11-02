@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            削除内容の確認
        </h2>
        <div class="review__group">
            <div class="review__group-title">
                店舗名
            </div>
            <div class="review__group-content">
                {{ $review->shop->name }}
            </div>
        </div>
        <div class="review__group">
            <div class="review__group-title">
                評価
            </div>
            <div class="review__group-content">
                {{ $review->rating }}
            </div>
        </div>
        <div class="review__group">
            <div class="review__group-title">
                コメント
            </div>
            <div class="review__group-content">
                {{ $review->comment }}
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('reviews.delete.delete', $review->id) }}" class="review-form" method="POST">
            @method('DELETE')
            @csrf
                <button class="confirm-button" type="submit">
                    削除する
                </button>
            </form>
            <a class="back-button" href="{{ route('users.mypage') }}">
                戻る
            </a>
        </div>
    </div>
</div>
@endsection
