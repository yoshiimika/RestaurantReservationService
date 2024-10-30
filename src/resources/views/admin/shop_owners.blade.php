@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop_owners.css') }}">
@endsection

@section('content')
<div class="shop_owners">
    <div class="shop_owners__header">
        <h2 class="shop_owners__title">店舗代表者一覧</h2>
    </div>
    <div class="shop_owners__table-wrapper">
        <table class="shop_owners__table">
            <tr class="shop_owners__row shop_owners__row--header">
                <th class="shop_owners__header-item">名前</th>
                <th class="shop_owners__header-item">メールアドレス</th>
                <th class="shop_owners__header-item">パスワード</th>
                <th class="shop_owners__header-item">店舗</th>
                <th class="shop_owners__header-item">アクション</th>
            </tr>
            @foreach($shopOwners as $shopOwner)
            <tr class="shop_owners__row">
                <td class="shop_owners__data-item">{{ $shopOwner->name }}</td>
                <td class="shop_owners__data-item">{{ $shopOwner->email }}</td>
                <td class="shop_owners__data-item">{{ str_repeat('●', 8) }}</td>
                <td class="shop_owners__data-item">{{ $shopOwner->shop ? $shopOwner->shop->name : '店舗無し' }}</td>
                <td class="shop_owners__data-item">
                    <div class="action-buttons">
                        <form action="{{ route('admin.edit.edit', $shopOwner->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="edit-btn">編集</button>
                        </form>
                        <form action="{{ route('admin.delete.confirm', $shopOwner->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="delete-btn">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="shop_owners__pagination">
    </div>
</div>
@endsection