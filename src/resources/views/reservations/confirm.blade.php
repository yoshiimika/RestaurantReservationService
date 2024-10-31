@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">予約内容の確認</h2>
        <div class="reservation__group">
            <div class="reservation__group-title">店舗名</div>
            <div class="reservation__group-content">{{ $shop->name }}</div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">予約日</div>
            <div class="reservation__group-content">{{ $date }}</div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">時間</div>
            <div class="reservation__group-content">{{ $time }}</div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">人数</div>
            <div class="reservation__group-content">{{ $number }}人</div>
        </div>
        <div class="button__group">
            <form action="{{ route('reservations.add') }}" method="POST" class="reservation-form">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="time" value="{{ $time }}">
                <input type="hidden" name="number" value="{{ $number }}">
                <button type="submit" class="confirm-button">予約を確定する</button>
                <button type="submit" class="back-button" name="back">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection
