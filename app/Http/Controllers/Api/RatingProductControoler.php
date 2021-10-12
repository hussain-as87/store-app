<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Rating;

class RatingProductControoler extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;

        $request->validate([
            'product_id' => 'required',
            'rating' => 'required',
            'status' => 'required',
        ]);

        $rate = Rating::where('product_id', $request->product_id)->where('user_id', $user)->first();
        if ($rate == null) {
           $store= Rating::create([
                'user_id' => $user,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'status' => $request->status
            ]);
            return new JsonResponse([
                'status' => '201',
                'message' => $store
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => 'alread rated!'
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;

        $request->validate([
            'product_id' => 'required'
        ]);

        $rate = Rating::where('product_id', $request->product_id)->where('user_id', $user)->first();
        $rate->delete();
        if ($rate) {
            return new JsonResponse([
                'status' => '201',
                'message' => 'nuRating : ' . $rate->product_id
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => 'not found !'
            ]);
        }
    }
}
