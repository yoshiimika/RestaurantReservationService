@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h2 class="confirm-title">
            この店舗代表者を削除しますか？
        </h2>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                名前
            </div>
            <div class="shop_owner-information__group-content">
                {{ $shopOwner->name }}
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                メールアドレス
            </div>
            <div class="shop_owner-information__group-content">
                {{ $shopOwner->email }}
            </div>
        </div>
        <div class="shop_owner-information__group">
            <div class="shop_owner-information__group-title">
                店舗
            </div>
            <div class="shop_owner-information__group-content">
                {{ $shopOwner->shop ? $shopOwner->shop->name : '店舗無し' }}
            </div>
        </div>
        <div class="button__group">
            <form action="{{ route('admin.delete.delete', $shopOwner->id) }}" class="shop_owner-form" method="POST">
            @method('DELETE')
            @csrf
                <button class="confirm-button" type="submit">
                    削除する
                </button>
            </form>
            <a class="back-button" href="{{ route('admin.shop_owners') }}">
                戻る
            </a>
        </div>
    </div>
</div>
@endsection