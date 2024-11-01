<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Mail\NotificationEmail;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create()
    {
        $shop = Auth::user()->shop;
        if ($shop) {
            $users = $shop->reservations()
                ->with('user')
                ->get()
                ->pluck('user')
                ->unique('id');
        } else {
            $users = collect();
        }
        return view('shop_owner.notification.create', compact('users'));
    }

    public function confirm(NotificationRequest $request)
    {
        $messageContent = $request->input('message_content');
        $userIds = $request->input('user_ids');
        $sentUsers = User::whereIn('id', $userIds)->get();
        return view('shop_owner.notification.confirm', compact('messageContent','sentUsers'));
    }

    public function send(NotificationRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('shop_owner.notification.create')->withInput();
        }
        $messageContent = $request->input('message_content');
        $userIds = $request->input('user_ids');
        $users = User::whereIn('id', $userIds)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationEmail($messageContent));
        }
        return redirect()->route('shop_owner.notification.done');
    }

    public function done()
    {
        return view('shop_owner.notification.done');
    }


    public function checkReservation($id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        return view('shop_owner.check', compact('reservation'));
    }
}
