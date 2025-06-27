<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductUnitResource;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductUnitResource::collection(ProductUnit::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productUnit = ProductUnit::create($validated);

        return new ProductUnitResource($productUnit);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductUnit $productUnit)
    {
        return new ProductUnitResource($productUnit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductUnit $productUnit)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:product_units,name,'.$productUnit->id.'|max:255'
        ]);

        $productUnit->update($validated);

        return new ProductUnitResource($productUnit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductUnit $productUnit)
    {
        $productUnit->destroy();
        return response()->json(null, 204);
    }
}
