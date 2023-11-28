<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Type';
        return view('admin.type.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        // Validate request
        $data = $request->validated();

        // Slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Save data
        Type::create($data);

        toast('Successfully Create Type', 'success');
        return redirect()->route('admin.type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.type.edit', [
            'type' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        // Validate request
        $data = $request->validated();

        // Slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Save data
        $type->update($data);

        toast('Successfully Updated Type', 'success');
        return redirect()->route('admin.type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
    }
}
