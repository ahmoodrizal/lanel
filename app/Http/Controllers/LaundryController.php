<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Tables\Laundries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laundries = Laundries::class;

        return view('admin.laundry.index', compact('laundries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->shop == null) {
            Splade::toast('Create a shop first')->warning()->autoDismiss(3);
            return redirect(route('shop.index'));
        }

        return view('admin.laundry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'weight' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'with_delivery' => ['nullable'],
            'with_pickup' => ['nullable'],
        ]);

        $price = auth()->user()->shop->promo == null ? auth()->user()->shop->price : auth()->user()->shop->promo->new_price;

        $data['pickup_address'] = $request['with_pickup'] ? $request['address'] : null;
        $data['delivery_address'] = $request['with_delivery'] ? $request['address'] : null;
        $data['shop_id'] = auth()->user()->shop->id;
        $data['claim_code'] = Str::random(6);
        $data['total'] = $request['weight'] * $price;

        Laundry::create($data);

        Splade::toast('Laundry created successfully')->autoDismiss(3);

        return redirect(route('laundry.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Laundry $laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laundry $laundry)
    {
        if ($laundry->with_pickup) {
            $laundry['address'] = $laundry->pickup_address;
        }
        $laundry['address'] = $laundry->delivery_address;

        return view('admin.laundry.edit', compact('laundry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laundry $laundry)
    {
        $data = $request->validate([
            'weight' => ['nullable'],
            'description' => ['nullable'],
            'address' => ['nullable'],
            'with_delivery' => ['nullable'],
            'with_pickup' => ['nullable'],
            'status' => ['nullable']
        ]);

        $price = auth()->user()->shop->price;

        $data['pickup_address'] = $request['with_pickup'] ? $request['address'] : null;
        $data['delivery_address'] = $request['with_delivery'] ? $request['address'] : null;
        $data['total'] = $request['weight'] * $price;

        $laundry->update($data);

        Splade::toast('Laundry updated successfully')->autoDismiss(3);

        return redirect(route('laundry.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laundry $laundry)
    {
        //
    }

    public function order()
    {
        return view('admin.laundry.claim');
    }

    public function claim(Request $request)
    {
        $request->validate([
            'claim_code' => ['required'],
            'laundry_id' => ['required'],
        ]);

        $laundry = Laundry::where([
            ['id', '=', $request['laundry_id']],
            ['claim_code', '=', $request['claim_code']],
        ])->first();

        if (!$laundry) {
            Splade::toast('laundry not found')->warning()->autoDismiss(3);
            return redirect(route('laundry.index'));
        }

        if ($laundry->user_id != 0 && $laundry->user_id != null) {
            Splade::toast('laundry has been claimed')->warning()->autoDismiss(3);
            return redirect(route('laundry.index'));
        }

        $laundry->user_id = auth()->user()->id;
        $laundry->save();

        Splade::toast('laundry claimed successfully')->autoDismiss(3);
        return redirect(route('laundry.index'));
    }
}
