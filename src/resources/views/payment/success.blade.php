@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/success.css') }}">
@endsection

@section('content')
<div class="success-container">
    <div class="success-card">
        <h2 class="success-title">
            支払いが完了しました
        </h2>
        <p>支払いが正常に処理されました。<br>ご利用ありがとうございます。</p>
    </div>
</div>
@endsection
