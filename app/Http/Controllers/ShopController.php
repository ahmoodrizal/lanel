<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.shop.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'city' => ['required'],
            'location' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'whatsapp' => ['required'],
            'delivery' => ['nullable'],
            'pickup' => ['nullable'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        if ($request->hasFile('image')) {
            // upload image
            $image = $request->file('image');
            $image->storeAs('public/shop', $image->hashName());

            $data['image'] = $image->hashName();
        }
        $data['user_id'] = auth()->user()->id;

        Shop::create($data);

        Splade::toast('Shop create successfully')->autoDismiss(3);

        return redirect(route('shop.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        if (auth()->user()->id != $shop->user_id) {
            abort(403);
        }

        $shop['image'] = ExistingFile::fromDisk('public')->get('shop/' . $shop->image);

        return view('admin.shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        if (auth()->user()->id != $shop->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required'],
            'city' => ['required'],
            'location' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'whatsapp' => ['required'],
            'delivery' => ['nullable'],
            'pickup' => ['nullable'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        $data['image'] = $shop->image;

        if ($request->hasFile('image')) {
            // upload image
            $image = $request->file('image');
            $image->storeAs('public/shop', $image->hashName());
            // delete old image
            Storage::delete('public/shop/' . $shop->image);
            $data['image'] = $image->hashName();
        }

        $shop->update($data);

        Splade::toast('Shop updated successfully')->autoDismiss(3);

        return redirect(route('shop.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        if (auth()->user()->id != $shop->user_id) {
            abort(403);
        }
    }
}
