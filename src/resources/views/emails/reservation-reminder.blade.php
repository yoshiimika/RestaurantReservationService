@component('mail::message')
# 予約リマインダーメール

{{ $reservation->user->name }} 様<br>
本日以下の内容で予約を受け付けています。

- 店舗名: {{ $reservation->shop->name }}
- 日付: {{ $reservation->date }}
- 時間: {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
- 人数: {{ $reservation->number }}人

ご来店お待ちしております。<br>
ご来店頂きましたら、添付のQRコードを店舗にご提示お願いします。

![QRコード]({{ $qrCodeCid }})

@endcomponent
