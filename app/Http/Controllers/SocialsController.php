<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Social::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->role == 'admin'){
            $social= new Social();
            $social->fill($request->all());
            $social->save();
            return response()->json(["msg"=> "social created successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Social::find($id);
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
        $social= Social::find($id);
        $social->fill($request->all());
        $social->save();
        return response()->json(["msg" => "socials upDate successfully"]);
    } else {
        return response(["msg" => "Not allow this action"], 401);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->role == 'admin'){
            $product = Social::find($id);
            $product->delete();
            return response()->json(["msg"=> "product delete successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }        
    }
}
