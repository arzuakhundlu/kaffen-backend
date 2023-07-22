<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::get();
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
            $comment= new Comment();
            $comment->fill($request->all());
            $comment->save();
            return response()->json(["msg"=> "comment created successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Comment::find($id);
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
            $comment = Comment::find($id);
            $comment->fill($request->all());
            $comment->save();
            return response()->json(["msg" => "comment upDate successfully"]);
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
            $comment = Comment::find($id);
            $comment->delete();
            return response()->json(["msg"=> "comment delete successfully"]);
        }else{
            return response(["msg"=>"Not allow this action"],401);
        }      
    }
}
