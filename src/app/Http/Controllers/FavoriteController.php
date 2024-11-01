<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($shopId)
    {
        $userId = Auth::id();
        $favorite = Favorite::where('user_id', $userId)
                            ->where('shop_id', $shopId)
                            ->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
            ]);
        }
        return redirect()->back();
    }
}
