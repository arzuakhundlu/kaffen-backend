<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function login(Request $request)
    {
       $user = User::where("email", $request->email)->first();
       if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json(["msg" => "invalid inc"], 401);
       } else {
           $token = $user->createToken("nigar_token")->plainTextToken;
           return response()->json(["user" =>$user, "token" => $token]);
       }
   }       

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        // $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(["msg"=>"User created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
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
    //    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    //   
    }
}
