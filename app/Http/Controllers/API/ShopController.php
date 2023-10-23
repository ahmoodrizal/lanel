<?php

namespace App\Http\Controllers\API;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    function readAll()
    {
        $shops = Shop::all();

        return response()->json([
            'data' => $shops,
        ], 200);
    }

    function readRecommendationLimit()
    {
        $shops = Shop::orderBy('rate', 'desc')
            ->limit(5)
            ->get();

        if (count($shops) > 0) {
            return response()->json([
                'data' => $shops->makeHidden('user_id'),
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
                'data' => $shops->makeHidden('user_id'),
            ], 404);
        }
    }

    function searchByCity($name)
    {
        $shops = Shop::where('city', 'like', '%' . $name . '%')
            ->orderBy('name')
            ->get();

        if (count($shops) > 0) {
            return response()->json([
                'data' => $shops->makeHidden('user_id'),
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
                'data' => $shops->makeHidden('user_id'),
            ], 404);
        }
    }
}
