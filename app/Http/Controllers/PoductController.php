<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PoductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with("menu")->get();
    }

    public function getData()
    {
        return Product::first();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function uploadImage($file)
    {
        $filename = time() . $file->getClientOriginalName();
        Storage::put("/public/images/{$filename}", File::get($file));
        return "images/{$filename}";
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $product = new Product();
            $product->fill($request->all());
            if($request->hasFile("image")){
                $product->image = $this->uploadImage($request->file("image"));
            }
            $product->save();
            return response()->json(["msg" => "product created successfully"]);
        } else {
            return response(["msg" => "Not allow this action"], 401);
        }
    }
    public function uploadImg2(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            Storage::put("/public/images/{$filename}", File::get($file));

            return response(["msg" => "Profile img upload successfully"]);
        } else {
            return response(["msg" => "File not supported"], 422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role == 'admin') {
            $product = Product::find($id);
            $product->fill($request->all());
            $product->save();
            return response()->json(["msg" => "product upDate successfully"]);
        } else {
            return response(["msg" => "Not allow this action"], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role == 'admin') {
            $product = Product::find($id);
            $product->delete();
            return response()->json(["msg" => "product delete successfully"]);
        } else {
            return response(["msg" => "Not allow this action"], 401);
        }
    }
}