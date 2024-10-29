<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin/shop_owners');
        } elseif ($user->hasRole('shop_owner')) {
            return redirect()->intended('/shop_owner/reservations');
        } elseif ($user->hasRole('user')) {
            return redirect()->intended('/mypage');
        }
    }
}
