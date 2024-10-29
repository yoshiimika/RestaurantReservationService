<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    private function getSearchQuery($request,$query)
    {
        if(!empty($request->area_id) && $request->area_id!='all'){
            $query->where('area_id',$request->area_id);
        }
        if(!empty($request->genre_id) && $request->genre_id!='all'){
            $query->where('genre_id',$request->genre_id);
        }
        if(!empty($request->name)){
            $query->where('name','like',"%{$request->name}%");
        }
        return $query;
    }

    public function search(Request $request){
        $query=Shop::query();
        $query=$this->getSearchQuery($request,$query);
        $shops = $query->get();
        $areas = Area::all();
        $genres = Genre::all();
        $userId = Auth::id();
        foreach ($shops as $shop) {
            $shop->is_favorite = Favorite::where('user_id', $userId)
                                        ->where('shop_id', $shop->id)
                                        ->exists();
        }
        return view('index',compact('shops','areas','genres','request'));
    }
}
