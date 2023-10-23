<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Splade;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.promo.index');
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

        return view('admin.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $old_price = Auth::user()->shop->price;

        $data = $request->validate([
            'new_price' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        if ($request['new_price'] >= $old_price) {
            Splade::toast('Promo price should be cheaper')->warning()->autoDismiss(3);
            return redirect(route('promo.create'));
        }

        $shop = Shop::where('user_id', auth()->user()->id)->first();

        $data['shop_id'] = $shop->id;
        $data['old_price'] = $shop->price;

        if ($request->hasFile('image')) {
            // upload image
            $image = $request->file('image');
            $image->storeAs('public/promo', $image->hashName());
            $data['image'] = $image->hashName();
        }

        Promo::create($data);

        Splade::toast('Promo create successfully')->autoDismiss(3);

        return redirect(route('promo.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'new_price' => ['required', 'lt:old_price'],
            'description' => ['required'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        $data['image'] = $promo->image;

        if ($request->hasFile('image')) {
            // upload image
            $image = $request->file('image');
            $image->storeAs('public/promo', $image->hashName());
            // delete old image
            Storage::delete('public/promo/' . $promo->image);
            $data['image'] = $image->hashName();
        }

        $promo->update($data);

        Splade::toast('Promo updated successfully')->autoDismiss(3);

        return redirect(route('promo.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        $promo->delete();
        Storage::delete('public/promo/' . $promo->image);

        Splade::toast('Promo deleted successfully')->autoDismiss(3);

        return redirect(route('promo.index'));
    }
}
