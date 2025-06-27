<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductGroupResource;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductGroupResource::collection(ProductGroup::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productGroup = ProductGroup::create($validated);

        return new ProductGroupResource($productGroup);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductGroup $productGroup)
    {
        return new ProductGroupResource($productGroup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductGroup $productGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productGroup->update($validated);

        return new ProductGroupResource($productGroup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGroup $productGroup)
    {
        $productGroup->delete();

        return response()->json(null, 204);
    }
}
