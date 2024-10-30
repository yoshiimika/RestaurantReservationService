<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopOwnerRequest;
use App\Http\Requests\UpdateShopOwnerRequest;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function shopOwnersList()
    {
        $shopOwners = User::whereHas('role', function ($query) {
            $query->where('name', 'shop_owner');
        })->get();
        return view('admin.shop_owners', compact('shopOwners'));
    }

    public function create()
    {
        $shops = Shop::all();
        return view('admin.create', compact('shops'));
    }

    public function confirm(CreateShopOwnerRequest $request)
    {
        $shopOwnerRole = Role::where('name', 'shop_owner')->first();
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'shop_id' => $request->input('shop_id'),
            'shop_name' => $request->shop_id ? Shop::find($request->shop_id)->name : '店舗無し',
            'role_id' => $shopOwnerRole->id,
        ];
        return view('admin.confirm', $data);
    }

    public function store(CreateShopOwnerRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.create')->withInput();
        }
        $shopOwnerRole = Role::where('name', 'shop_owner')->first();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id ?: null,
            'role_id' => $shopOwnerRole->id,
        ]);
        return redirect()->route('admin.done');
    }

    public function done()
    {
        return view('admin.done');
    }

    public function edit(User $shopOwner)
    {
        $shops = Shop::all();
        return view('admin.edit.edit', compact('shopOwner', 'shops'));
    }

    public function updateConfirm(UpdateShopOwnerRequest $request, User $shopOwner)
    {
        $data = [
            'shopOwner' => $shopOwner,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'shop_id' => $request->input('shop_id'),
            'shop_name' => $request->input('shop_id') ? Shop::find($request->input('shop_id'))->name : '店舗無し',
            'current_password' => $request->input('current_password'),
            'new_password' => $request->input('new_password'),
        ];
        return view('admin.edit.confirm', $data);
    }

    public function update(UpdateShopOwnerRequest $request, User $shopOwner)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.edit.edit', $shopOwner->id)->withInput();
        }
        if ($request->filled('new_password')) {
            $shopOwner->password = Hash::make($request->new_password);
        }
        $shopOwner->name = $request->name;
        $shopOwner->email = $request->email;
        $shopOwner->shop_id = $request->shop_id ?: null;
        $shopOwner->save();
        return redirect()->route('admin.edit.done');
    }


    public function updateDone()
    {
        return view('admin.edit.done');
    }

    public function deleteConfirm(User $shopOwner)
    {
        return view('admin.delete.confirm', compact('shopOwner'));
    }

    public function delete(User $shopOwner)
    {
        $shopOwner->delete();
        return redirect()->route('admin.delete.done');
    }

    public function deleteDone()
    {
        return view('admin.delete.done');
    }
}
