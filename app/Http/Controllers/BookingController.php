<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booking::get();
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
        // if(auth()->user()->role == 'admin'){
            $booking= new Booking();
            $booking->fill($request->all());
            $booking->save();
            return response()->json(["msg"=> "booking created successfully"]);
        // }else{
        //     return response(["msg"=>"Not allow this action"],401);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Booking::find($id);
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
            $booking = Booking::find($id);
            $booking->fill($request->all());
            $booking->save();
            return response()->json(["msg" => "booking upDate successfully"]);
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
            $booking = Booking::find($id);
            $booking->delete();
            return response()->json(["msg"=> "booking delete successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }      
    }
}
