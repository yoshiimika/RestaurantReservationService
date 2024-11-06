@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="shop-list">
        @foreach($shops as $shop)
        <div class="shop-item">
            <img alt="{{ $shop->name }}" class="shop-image" src="{{ $shop->image_url }}">
            <div class="shop-info">
                <h2 class="shop-name">
                    {{ $shop->name }}
                </h2>
                <p class="shop-tags">
                    #{{ $shop->area->name }} #{{ $shop->genre->name }}
                </p>
                <a class="details-button" href="{{route('shops.detail',['shop_id' => $shop->id,'from' => 'index'])}}">
                    詳しくみる
                </a>
                <form action="{{ route('favorite.toggle', $shop->id) }}" class="favorite-form" method="POST">
                @csrf
                    <button class="favorite-button" type="submit">
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