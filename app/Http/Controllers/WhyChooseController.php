<?php

namespace App\Http\Controllers;

use App\Models\WhyChoose;
use Illuminate\Http\Request;

class WhyChooseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WhyChoose::get();
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
            $whychoose= new WhyChoose();
            $whychoose->fill($request->all());
            $whychoose->save();
            return response()->json(["msg"=> "whychoose$ created successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return WhyChoose::find($id);
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
        $whychoose= WhyChoose::find($id);
        $whychoose->fill($request->all());
        $whychoose->save();
        return response()->json(["msg" => "whychoose upDate successfully"]);
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
            $whychoose = WhyChoose::find($id);
            $whychoose->delete();
            return response()->json(["msg"=> "whychoose delete successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }     
    }
}
