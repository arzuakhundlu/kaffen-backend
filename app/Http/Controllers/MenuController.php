<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Menu::get();
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

     public function uploadImg($file)    
    {
        
            $filename = time() . $file->getClientOriginalName();
            Storage::put("/public/images/{$filename}", File::get($file));
            return "images/{$filename}";
          
    }   
    public function store(Request $request)
    {
        if(auth()->user()->role == 'admin'){
            $menu= new Menu();
            $menu->fill($request->all());
            if($request->hasFile("image")){
                $menu->image = $this->uploadImg($request->file("image"));
            }
            $menu->save();
            return response()->json(["msg"=> "menu created successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Menu::find($id);
        
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
            $menu = Menu::find($id);
            $menu->fill($request->all());
            if($request->hasFile("image")){
                $menu->image = $this->uploadImg($request->file("image"));
            }
            $menu->save();
            return response()->json(["msg" => "menu upDate successfully"]);
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
            $menu = Menu::find($id);
            $menu->delete();
            return response()->json(["msg"=> "menu delete successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }        
    }
}