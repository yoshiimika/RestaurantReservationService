@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-header">
    <h2>{{ $user->name }}さん</h2>
</div>
<div class="mypage-container">
    <div class="left-section">
        <div class="reservation-section">
            <h3>予約状況</h3>
            @forelse ($futureReservations as $reservation)
            <div class="reservation-card">
                <h4>予約{{ $loop->iteration }}</h4>
                <div class="reservation-summary">
                    <p><strong class="reservation-summary-title">Shop</strong>{{ $reservation->shop->name }}</p>
                    <p><strong class="reservation-summary-title">Date</strong>{{ $reservation->date }}</p>
                    <p><strong class="reservation-summary-title">Time</strong>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                    <p><strong class="reservation-summary-title">Number</strong>{{ $reservation->number }}人</p>
                </div>
                <form action="{{ route('reservations.edit.edit', $reservation->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="edit-button">予約変更</button>
                </form>
                <form action="{{ route('reservations.delete.confirm', $reservation->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="cancel-button">×</button>
                </form>
            </div>
            @empty
                <p>予約はありません。</p>
            @endforelse
        </div>
        <div class="reservation-section">
            <h3>予約履歴</h3>
            @forelse ($pastReservations as $reservation)
            <div class="reservation-card">
                <h4>予約{{ $loop->iteration }}</h4>
                <div class="reservation-summary">
                    <p><strong class="reservation-summary-title">Shop</strong>{{ $reservation->shop->name }}</p>
                    <p><strong class="reservation-summary-title">Date</strong>{{ $reservation->date }}</p>
                    <p><strong class="reservation-summary-title">Time</strong>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                    <p><strong class="reservation-summary-title">Number</strong>{{ $reservation->number }}人</p>
                </div>
                <form action="{{ route('reviews.create', $reservation->shop->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="review-button">レビューを書く</button>
                </form>
            </div>
            @empty
                <p>予約履歴はありません。</p>
            @endforelse
        </div>
        <div class="review-section">
            <h3>あなたのレビュー</h3>
            @forelse ($reviews as $review)
            <div class="review-card">
                <h4>レビュー{{ $loop->iteration }}</h4>
                <div class="review-summary">
                    <p><strong class="review-summary-title">Shop</strong>{{ $review->shop->name }}</p>
                    <p><strong class="review-summary-title">Rating</strong>{{ $review->rating }} / 5</p>
                    <p><strong class="review-summary-title">Comment</strong>{{ $review->comment }}</p>
                </div>
                <form action="{{ route('reviews.edit.edit', $review->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="edit-button">レビューを編集する</button>
                </form>
                <form action="{{ route('reviews.delete.confirm', $review->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="cancel-button">×</button>
                </form>
            </div>
            @empty
                <p>現在、投稿したレビューはありません。</p>
            @endforelse
        </div>
    </div>
    <div class="right-section">
        <div class="favorites-section">
            <h3>お気に入り店舗</h3>
            <div class="favorites-list">
                @foreach($favorites as $favorite)
                <div class="favorite-item">
                    <img src="{{ asset($favorite->shop->image_url) }}" alt="{{ $favorite->shop->name }}">
                    <div class="favorite-info">
                        <h2>{{ $favorite->shop->name }}</h2>
                        <p>#{{ $favorite->shop->area->name }} #{{ $favorite->shop->genre->name }}</p>
                        <a href="{{ route('shops.detail', ['shop_id' => $favorite->shop->id, 'from' => 'mypage']) }}" class="details-button">詳しくみる</a>
                        <form action="{{ route('favorite.toggle', $favorite->shop->id) }}" class="favorite-form" method="POST">
                            @csrf
                            <button type="submit" class="favorite-button active">❤︎</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
