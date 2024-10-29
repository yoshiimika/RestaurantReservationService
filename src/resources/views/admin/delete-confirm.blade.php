@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">この店舗代表者を削除しますか？</h2>
        <div class="shop_owner-summary">
            <p class="shop_owner-item">名前: {{ $shopOwner->name }}</p>
            <p class="shop_owner-item">メールアドレス: {{ $shopOwner->email }}</p>
            <p class="shop_owner-item">店舗: {{ $shopOwner->shop ? $shopOwner->shop->name : '店舗無し' }}</p>
        </div>
        <div class="button-group">
            <form action="{{ route('admin.delete', $shopOwner->id) }}" method="POST" class="shop_owner-form">
                @method('DELETE')
                @csrf
                <button type="submit" class="confirm-button">削除する</button>
            </form>
            <a href="{{ route('admin.shop_owners') }}" class="back-button">戻る</a>
        </div>
    </div>
</div>
@endsection