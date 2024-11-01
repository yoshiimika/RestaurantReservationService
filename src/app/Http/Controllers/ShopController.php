<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();
        $userId = Auth::id();
        foreach ($shops as $shop) {
            $shop->is_favorite = Favorite::where('user_id', $userId)
                                        ->where('shop_id', $shop->id)
                                        ->exists();
        }
        return view('index', compact('areas','genres','shops'));
    }

    public function detail(Request $request)
    {
        $shop = Shop::with('reviews')->findOrFail($request->shop_id);
        $from = $request->input('from');
        $backRoute = '/';
        switch ($from) {
            case 'index':
                $backRoute = '/';
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
        }
        return view('detail', compact('shop','backRoute'));
    }
}
