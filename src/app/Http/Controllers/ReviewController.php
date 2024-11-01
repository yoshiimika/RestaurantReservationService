<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Shop $shop)
    {
        return view('reviews.create', compact('shop'));
    }

    public function confirm(ReviewRequest $request, Shop $shop)
    {
        $data = [
            'user_id' => Auth::id(),
            'shop_id' => $shop->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'shop' => $shop
        ];
        return view('reviews.confirm', $data);
    }

    public function store(ReviewRequest $request, Shop $shop)
    {
        if ($request->has('back')) {
            return redirect()->route('reviews.create', $shop->id)->withInput();
        }
        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('reviews.done', $shop->id);
    }

    public function done()
    {
        return view('reviews.done');
    }

    public function edit(Review $review)
    {
        return view('reviews.edit.edit', compact('review'));
    }

    public function updateConfirm(ReviewRequest $request, Review $review)
    {
        $data = [
            'review' => $review,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];
        return view('reviews.edit.confirm', $data);
    }

    public function update(ReviewRequest $request, Review $review)
    {
        if ($request->has('back')) {
            return redirect()->route('reviews.edit.edit', $review->id)->withInput();
        }
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('reviews.edit.done', $review->id);
    }

    public function updateDone()
    {
        return view('reviews.edit.done');
    }

    public function deleteConfirm(Review $review)
    {
        return view('reviews.delete.confirm', compact('review'));
    }

    public function delete(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.delete.done', $review->id);
    }

    public function deleteDone()
    {
        return view('reviews.delete.done');
    }
}
