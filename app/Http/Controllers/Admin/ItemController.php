<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Item';
        return view('admin.item.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Item';

        $brands = Brand::all();
        $types = Type::all();
        return view('admin.item.create', compact('title', 'brands', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        // Validate request
        $data = $request->validated();

        // Generate slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photos = [];

            // Looping photos
            foreach ($request->file('photos') as $photo) {
                // Path photos
                $photoPath = $photo->store('assets/item', 'public');

                // Push to array photos
                array_push($photos, $photoPath);
            }

            // Save photos
            $data['photos'] = json_encode($photos);
        }

        // Save data item
        Item::create($data);

        toast('Successfully Create Item', 'success');
        return redirect()->route('admin.item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // Load relation data
        $item->load('brand', 'type');

        // Get all relation data
        $brands = Brand::all();
        $types = Type::all();

        return view('admin.item.edit', compact('item', 'types', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        // Validate request
        $data = $request->validated();

        // Generate slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Upload multiple photos, if there is a new photos
        if ($request->hasFile('photos')) {
            $photos = [];

            // Looping photos
            foreach ($request->file('photos') as $photo) {
                // Path photos
                $photoPath = $photo->store('assets/item', 'public');

                // Push to array photos
                array_push($photos, $photoPath);
            }

            // Delete old photos
            $oldPhotos = json_decode($item->photos, true) ?? [];
            foreach ($oldPhotos as $oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }

            // Save photos
            $data['photos'] = json_encode($photos);
        } else {
            $data['photos'] = $item->photos;
        }

        // Update data item
        $item->update($data);

        toast('Successfully Updated Item', 'success');
        return redirect()->route('admin.item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
