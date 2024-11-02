@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/cancel.css') }}">
@endsection

@section('content')
<div class="cancel-container">
    <div class="cancel-card">
        <h2 class="cancel-title">
            支払いがキャンセルされました
        </h2>
        <p>支払いがキャンセルされました。<br>再度お試しください。</p>
    </div>
</div>
@endsection
