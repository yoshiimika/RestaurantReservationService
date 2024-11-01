<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function confirm(ReservationRequest $request)
    {
        $shop = Shop::find($request->shop_id);
        $data = [
            'shop' => $shop,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ];
        return view('reservations.confirm', $data);
    }

    public function add(ReservationRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('shops.detail', $request->shop_id)->withInput();
        }
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $request->shop_id;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->status = '予約済み';
        $reservation->save();
        return redirect()->route('reservations.done');
    }

    public function done()
    {
        return view('reservations.done');
    }

    public function edit(Reservation $reservation)
    {
        $shop = $reservation->shop;
        return view('reservations.edit.edit', compact('reservation', 'shop'));
    }

    public function updateConfirm(ReservationRequest $request, Reservation $reservation)
    {
        $data = [
            'shop' => $reservation->shop,
            'reservation' => $reservation,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number')
        ];
        return view('reservations.edit.confirm', $data);
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        if ($request->has('back')) {
            return redirect()->route('reservations.edit.edit', $reservation->id)->withInput();
        }
        $reservation->update([
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);
        return redirect()->route('reservations.edit.done');
    }

    public function updateDone()
    {
        return view('reservations.edit.done');
    }

    public function deleteConfirm(Reservation $reservation)
    {
        return view('reservations.delete.confirm', compact('reservation'));
    }

    public function delete(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.delete.done', $reservation->id);
    }

    public function deleteDone()
    {
        return view('reservations.delete.done');
    }
}