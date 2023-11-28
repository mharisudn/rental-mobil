<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $item = Item::with(['brand', 'type'])
            ->whereSlug($slug)
            ->firstOrFail();

        $similiarItems = Item::with('brand', 'type')
            ->where('id', '!=', $item->id)
            ->get();

        return view('detail', [
            'item' => $item,
            'similiarItems' => $similiarItems
        ]);
    }
}
