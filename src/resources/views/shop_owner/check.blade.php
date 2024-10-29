<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約確認</title>
    <link rel="stylesheet" href="{{ asset('css/shop_owner/check.css') }}">
</head>
<body class="reservation-confirmation">
    <header class="header">
        <h1 class="header__title">予約の確認</h1>
    </header>

    <main class="reservation-details">
        <p class="reservation-details__item">予約ID: <span class="reservation-details__value">{{ $reservation->id }}</span></p>
        <p class="reservation-details__item">予約日: <span class="reservation-details__value">{{ $reservation->date }}</span></p>
        <p class="reservation-details__item">予約時間: <span class="reservation-details__value">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</span></p>
        <p class="reservation-details__item">予約人数: <span class="reservation-details__value">{{ $reservation->number }}人</span></p>
    </main>
</body>
</html>
