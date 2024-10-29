<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use Illuminate\Http\Request;

class CustomVerifyEmailResponse implements VerifyEmailResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('thanks');
    }
}
