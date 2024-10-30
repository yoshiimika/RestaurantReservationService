@extends('layouts.shop_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner/reservations.css') }}">
@endsection

@section('content')
<div class="reservations">
  @if ($reservations !== null)
    <div class="reservations__header">
      <h2 class="reservations__title">{{ Auth::user()->shop->name }}の予約一覧</h2>
    </div>
    <div class="reservations__date-selector">
      <form class="reservations__form" action="{{ route('shop_owner.per.date') }}" method="post">
        @csrf
        <button type="submit" class="reservations__date-button reservations__date-button--prev" name="prevDate" value="{{ $displayDate }}"><</button>
        <input type="hidden" name="displayDate" value="{{ $displayDate }}">
        <p class="reservations__date-text">{{ $displayDate }}</p>
        <button type="submit" class="reservations__date-button reservations__date-button--next" name="nextDate" value="{{ $displayDate }}">></button>
      </form>
    </div>
    <div class="reservations__table-wrapper">
      @if($reservations->isEmpty())
        <p class="reservations__no-data">現在予約はありません。</p>
      @else
        <table class="reservations__table">
          <tr class="reservations__row reservations__row--header">
            <th class="reservations__header-item">予約者名</th>
            <th class="reservations__header-item">予約日</th>
            <th class="reservations__header-item">時間</th>
            <th class="reservations__header-item">人数</th>
          </tr>
          @foreach($reservations as $reservation)
          <tr class="reservations__row">
            <td class="reservations__data-item">{{ $reservation->user->name }}</td>
            <td class="reservations__data-item">{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}</td>
            <td class="reservations__data-item">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
            <td class="reservations__data-item">{{ $reservation->number }}</td>
          </tr>
          @endforeach
        </table>
      @endif
    </div>
    <div class="reservations__pagination">
      {{ $reservations->appends(['displayDate' => $displayDate])->links('vendor/pagination/paginate') }}
    </div>
  @else
    <div class="reservations__header">
      <h2 class="reservations__no-shop">店舗が作成されていません。</h2>
    </div>
  @endif
</div>
@endsection