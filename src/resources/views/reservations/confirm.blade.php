@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservations/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            予約内容の確認
        </h2>
        <div class="reservation__group">
            <div class="reservation__group-title">
                店舗名
            </div>
            <div class="reservation__group-content">
                {{ $shop->name }}
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
            <form action="{{ route('reservations.add') }}" class="reservation-form" method="POST">
            @csrf
                <input name="shop_id" type="hidden" value="{{ $shop->id }}">
                <input name="date" type="hidden" value="{{ $date }}">
                <input name="time" type="hidden" value="{{ $time }}">
                <input name="number" type="hidden" value="{{ $number }}">
                <button class="confirm-button" type="submit">
                    予約を確定する
                </button>
                <button class="back-button" name="back" type="submit">
                    戻る
                </button>
            </form>
        </div>
    </div>
</div>
@endsection