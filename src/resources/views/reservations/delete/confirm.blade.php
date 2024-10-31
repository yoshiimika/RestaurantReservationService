@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">キャンセル内容の確認</h2>
        <div class="reservation__group">
            <div class="reservation__group-title">予約日</div>
            <div class="reservation__group-content">{{ $reservation->date }}</div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">時間</div>
            <div class="reservation__group-content">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">人数</div>
            <div class="reservation__group-content">{{ $reservation->number }}人</div>
        </div>
        <div class="button__group">
            <form action="{{ route('reservations.delete.delete', $reservation->id) }}" method="POST" class="reservation-form">
            @method('DELETE')
            @csrf
                <button type="submit" class="confirm-button">キャンセルする</button>
            </form>
            <a href="{{ route('users.mypage') }}" class="back-button">戻る</a>
        </div>
    </div>
</div>
@endsection
