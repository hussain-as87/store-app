<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\favoriteProduct;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class FavoriteProductControoler extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;

        $request->validate([
            'product_id' => 'required'
        ]);

        $favorite = favoriteProduct::where('product_id', $request->product_id)->where('user_id', $user)->first();

        if ($favorite == null) {
            $store = favoriteProduct::create(['user_id' => $user, 'product_id' => $request->product_id]);
            return new JsonResponse([
                'status' => '201',
                'message' => $store
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => 'already added to favorites list!',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;

        $request->validate([
            'product_id' => 'required'
        ]);

        $favorite = favoriteProduct::where('product_id', $request->product_id)->where('user_id', $user)->first();
        $favorite->delete();
        if ($favorite) {
            return new JsonResponse([
                'status' => '201',
                'message' => 'nufollow : ' . $favorite->product_id
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => 'not found !'
            ]);
        }
    }
}
