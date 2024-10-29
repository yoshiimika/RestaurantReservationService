@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/input-amount.css') }}">
@endsection

@section('content')
<div class="input-amount-form__content">
    <div class="input-amount-form__heading">
        <h2>支払い金額を入力してください</h2>
    </div>
    <form class="form" action="{{ route('payment.checkout') }}" method="GET">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">金額 (円)</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--amount">
                    <input type="number" name="amount" id="amount" placeholder="例: 5000">
                </div>
                <div class="form__error">
                    @error('amount')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">支払いに進む</button>
        </div>
    </form>
</div>
@endsection
