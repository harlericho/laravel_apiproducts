<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Http\Requests\EditRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list all products
        return response()->json([
            'message' => true,
            'products' => Product::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        // create route image upload product
        if ($request->hasFile('image')) {
            $path = $request->code . '_' . time() . '.' . $request->image->extension();
            $request->image->storeAs('public/uploads', $path);
        } else {
            $path = null;
        }
        // create a new product
        Product::create([
            'code' => $request->code,
            'names' => $request->names,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path
        ]);
        return response()->json([
            'message' => true,
            'product' => 'Product created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // list a single product
        return response()->json([
            'message' => true,
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Product $product)
    {
        // update a product
        if ($request->hasFile('image')) {
            if ($product->image != null) {
                $path = $request->code . '_' . time() . '.' . $request->image->extension();
                $request->image->storeAs('public/uploads', $path);
                Storage::delete('public/uploads/' . $product->image);
            } else {
                $path = $request->code . '_' . time() . '.' . $request->image->extension();
                $request->image->storeAs('public/uploads', $path);
            }
        }
        $product->update([
            'code' => $request->code ?? $product->code,
            'names' => $request->names ?? $product->names,
            'description' => $request->description ?? $product->description,
            'price' => $request->price ?? $product->price,
            'image' => $path ?? $product->image
        ]);
        return response()->json([
            'message' => true,
            'product' => 'Product updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // delete a product
        if ($product->image != null) {
            Storage::delete('public/uploads/' . $product->image);
        }
        $product->delete();
        return response()->json([
            'message' => true,
            'product' => 'Product deleted successfully'
        ], 200);
    }
}
