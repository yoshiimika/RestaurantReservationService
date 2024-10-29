@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="shop-list">
        @foreach($shops as $shop)
        <div class="shop-item">
            <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->name }}">
            <div class="shop-info">
                <h2>{{ $shop->name }}</h2>
                <p>#{{ $shop->area->name }} #{{ $shop->genre->name }}</p>
                <a href="{{route('shops.detail',['shop_id' => $shop->id,'from' => 'index'])}}" class="details-button">詳しくみる</a>
                <form method="POST" action="{{ route('favorite.toggle', $shop->id) }}" class="favorite-form">
                    @csrf
                    <button type="submit" class="favorite-button">
                        @if($shop->is_favorite)
                            <span class="favorite-icon active">❤︎</span>
                        @else
                            <span class="favorite-icon">❤︎</span>
                        @endif
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
