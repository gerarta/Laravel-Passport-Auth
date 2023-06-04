<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return new PostCollection($posts) ;
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function validateRequest($request){
        $request->validate([
            'message' => 'required|string',
            'author_id' => 'required|integer'
        ]);
        
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        Post::create([
            'message' => $request->message,
            'author_id' => $request->author_id
        ]);
        return response()->json($request);
    }

    
    
    public function show(string $id)
    {
        $post = Post::find($id);
        if(!$post) return response()->json(['error' => 'data not found']);
        return response()->json($post);
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $post = Post::find($id);
        $post->update($request);
        return response()->json($post);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json($post);
        
    }
}
