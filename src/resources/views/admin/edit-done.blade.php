@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h2 class="done-title">店舗代表者情報を変更しました</h2>
        <a href="{{ route('admin.shop_owners') }}" class="back-button">店舗代表者一覧画面に戻る</a>
    </div>
</div>
@endsection
