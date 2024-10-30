@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reservations/edit.css') }}">
@endsection

@section('content')
<div class="reservation-container">
    <div class="shop-info">
        <div class="shop-header">
            <a href="{{ route('users.mypage') }}" class="back-button"><</a>
            <h1 class="shop-name">{{ $shop->name }}</h1>
        </div>
        <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->name }}" class="shop-image">
        <p class="shop-tags">#{{ $shop->area->name }} #{{ $shop->genre->name }}</p>
        <p class="shop-description">{{ $shop->outline }}</p>
    </div>
    <div class="reservation-edit">
        <h2>予約変更</h2>
        <form action="{{ route('reservations.edit.confirm', $reservation->id) }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
            </div>
            <div class="input-group">
                <input type="date" id="date" name="date" value="{{ old('date', $reservation->date) }}">
            </div>
            <div class="error__group">
                @error('date')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="time" id="time" name="time" value="{{ old('time', \Carbon\Carbon::parse($reservation->time)->format('H:i')) }}">
            </div>
            <div class="error__group">
                @error('time')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="number" id="number" name="number" value="{{ old('number', $reservation->number) }}" min="1">
            </div>
            <div class="error__group">
                @error('number')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="reservation-summary">
                <p><strong class="reservation-summary-title">Shop</strong>{{ $shop->name }}</p>
                <p><strong class="reservation-summary-title">Date</strong><span id="selected-date"></span></p>
                <p><strong class="reservation-summary-title">Time</strong><span id="selected-time"></span></p>
                <p><strong class="reservation-summary-title">Number</strong><span id="selected-number"></span></p>
            </div>
            <button type="submit" class="edit-button">変更内容を確認する</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateSummary(field, value) {
        if (field === 'number') {
            if (value) {
                document.getElementById('selected-' + field).innerText = value + '人';
            } else {
                document.getElementById('selected-' + field).innerText = '';
            }
        } else {
            document.getElementById('selected-' + field).innerText = value;
        }
    }

    document.getElementById('date').addEventListener('change', function() {
        updateSummary('date', this.value);
    });

    document.getElementById('time').addEventListener('change', function() {
        updateSummary('time', this.value);
    });

    document.getElementById('number').addEventListener('input', function() {
        updateSummary('number', this.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateSummary('date', document.getElementById('date').value);
        updateSummary('time', document.getElementById('time').value);
        updateSummary('number', document.getElementById('number').value || '');
    });
</script>
@endsection