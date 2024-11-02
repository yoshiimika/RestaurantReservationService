@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            予約変更内容の確認
        </h2>
        <div class="reservation__group">
            <div class="reservation__group-title">
                店舗名
            </div>
            <div class="reservation__group-content">
                {{ $reservation->shop->name }}
            </div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">
                予約日
            </div>
            <div class="reservation__group-content">
                {{ $date }}
            </div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">
                時間
            </div>
            <div class="reservation__group-content">
                {{ $time }}
            </div>
        </div>
        <div class="reservation__group">
            <div class="reservation__group-title">
                人数
            </div>
            <div class="reservation__group-content">
                {{ $number }}人
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('reservations.edit.update', $reservation->id) }}" class="reservation-form" method="POST">
            @method('PATCH')
            @csrf
                <input name="shop_id" type="hidden" value="{{ $reservation->shop->id }}">
                <input name="date" type="hidden" value="{{ $date }}">
                <input name="time" type="hidden" value="{{ $time }}">
                <input name="number" type="hidden" value="{{ $number }}">
                <button class="confirm-button" type="submit">
                    変更する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection