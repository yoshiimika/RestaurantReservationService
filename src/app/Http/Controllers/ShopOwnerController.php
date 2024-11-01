<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopOwnerController extends Controller
{
    public function viewReservations(Request $request)
    {
        $displayDate = $request->input('displayDate', Carbon::today()->toDateString());
        $shop = Auth::user()->shop;
        if ($shop) {
            $reservations = $shop->reservations()
                ->whereDate('date', $displayDate)
                ->orderBy('time', 'asc')
                ->paginate(5);
        } else {
            $reservations = null;
        }
        return view('shop_owner.reservations', compact('displayDate', 'shop', 'reservations'));
    }

    public function filterByDate(Request $request)
    {
        $displayDate = $request->input('displayDate', Carbon::today()->toDateString());
        if ($request->has('prevDate')) {
            $displayDate = Carbon::parse($displayDate)->subDay()->toDateString();
        } elseif ($request->has('nextDate')) {
            $displayDate = Carbon::parse($displayDate)->addDay()->toDateString();
        }
        $shop = Auth::user()->shop;
        $reservations = $shop->reservations()
            ->whereDate('date', $displayDate)
            ->orderBy('time', 'asc')
            ->paginate(5);
        return view('shop_owner.reservations', compact('displayDate', 'shop', 'reservations'));
    }

    public function create()
    {
        $shop = Auth::user()->shop;
        $areas = Area::all();
        $genres = Genre::all();
        return view('shop_owner.shop.create', compact('shop', 'areas', 'genres'));
    }

    public function confirm(ShopRequest $request)
    {
        $storedImagePath = null;
        if ($request->hasFile('shop_image')) {
            $image = $request->file('shop_image');
            $hash = md5_file($image->getRealPath());
            $directory = 'public/shop-images';
            $imageName = $hash . '.' . $image->getClientOriginalExtension();
            $storedImagePath = $directory . '/' . $imageName;
            if (!Storage::exists($storedImagePath)) {
                $image->storeAs($directory, $imageName);
            }
            $storedImagePath = 'storage/shop-images/' . $imageName;
            $request->session()->put('shop_data.image', $storedImagePath);
        }
        $data = [
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            'genre' => $request->input('genre'),
            'image' => $storedImagePath,
            'outline' => $request->input('outline'),
            'area_name' => Area::find($request->input('area'))->name ?? '選択されていません',
            'genre_name' => Genre::find($request->input('genre'))->name ?? '選択されていません',
        ];
        return view('shop_owner.shop.confirm', $data);
    }

    public function store(ShopRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('shop_owner.shop.create')->withInput();
        }
        $imagePath = $request->session()->get('shop_data.image');
        $shop = Shop::create([
            'name' => $request->input('name'),
            'area_id' => $request->input('area'),
            'genre_id' => $request->input('genre'),
            'image_url' => $imagePath,
            'outline' => $request->input('outline'),
        ]);
        $user = Auth::user();
        $user->shop_id = $shop->id;
        $user->save();
        $request->session()->forget('shop_data.image');
        return redirect()->route('shop_owner.shop.done')->with('shopName', $shop->name);
    }


    public function done()
    {
        return view('shop_owner.shop.done');
    }

    public function edit(Shop $shop)
    {
        $areas = Area::all();
        $genres = Genre::all();
        return view('shop_owner.edit.edit', compact('shop', 'areas', 'genres'));
    }

    public function updateConfirm(ShopRequest $request, Shop $shop)
    {
        $storedImagePath = $shop->image_url;
        if ($request->hasFile('shop_image')) {
            $image = $request->file('shop_image');
            $hash = md5_file($image->getRealPath());
            $directory = 'public/shop-images';
            $imageName = $hash . '.' . $image->getClientOriginalExtension();
            $newImagePath = $directory . '/' . $imageName;
            if (!Storage::exists($newImagePath)) {
                $image->storeAs($directory, $imageName);
            }
            $storedImagePath = 'storage/shop-images/' . $imageName;
            $request->session()->put('shop_update_image', $storedImagePath);
        }
        $data = [
            'shop' => $shop,
            'name' => $request->input('name'),
            'area' => Area::find($request->input('area')),
            'genre' => Genre::find($request->input('genre')),
            'image_url' => $storedImagePath,
            'outline' => $request->input('outline'),
        ];
        return view('shop_owner.edit.confirm', $data);
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        if ($request->has('back')) {
            return redirect()->route('shop_owner.shop.edit.edit', $shop->id)->withInput();
        }
        $imagePath = $request->session()->get('shop_update_image', $shop->image_url);
        $shop->update([
            'name' => $request->input('name'),
            'area_id' => $request->input('area'),
            'genre_id' => $request->input('genre'),
            'image_url' => $imagePath,
            'outline' => $request->input('outline'),
        ]);
        $request->session()->forget('shop_update_image');
        return redirect()->route('shop_owner.shop.edit.done');
    }

    public function updateDone()
    {
        return view('shop_owner.edit.done');
    }
}
