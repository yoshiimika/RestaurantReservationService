<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $currentDateTime = Carbon::now();

        $pastReservations = Reservation::where('user_id', $user->id)
            ->where(function ($query) use ($currentDateTime) {
                $query->where('date', '<', $currentDateTime->format('Y-m-d'))
                        ->orWhere(function ($query) use ($currentDateTime) {
                            $query->where('date', '=', $currentDateTime->format('Y-m-d'))
                                    ->where('time', '<', $currentDateTime->format('H:i'));
                        });
            })
            ->with('shop')
            ->get();

        $futureReservations = Reservation::where('user_id', $user->id)
            ->where(function ($query) use ($currentDateTime) {
                $query->where('date', '>', $currentDateTime->format('Y-m-d'))
                        ->orWhere(function ($query) use ($currentDateTime) {
                            $query->where('date', '=', $currentDateTime->format('Y-m-d'))
                                    ->where('time', '>=', $currentDateTime->format('H:i'));
                        });
            })
            ->with('shop')
            ->get();


        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop')
            ->get();

        $reviews = Review::where('user_id', $user->id)
            ->with('shop')
            ->get();

        return view('mypage', compact('user', 'pastReservations', 'futureReservations', 'favorites', 'reviews'));
    }
}
