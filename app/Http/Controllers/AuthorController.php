<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Resources\authors\AuthorCollection;

class AuthorController extends Controller
{
 
    public function index()
    {
        $authors = Author::all();
        if (!$authors->count()) 
            return response()->json([
                'message' => 'no data found'
            ]);
        
        return new AuthorCollection($authors);
    }

 
 
    public function store(Request $request)
    {
        $this->validateRequest($request);
        Author::create([
            'name' => $request->name,
        ]);

        return response()->json($request->all());
    }

  
    public function show(string $id)
    {
        $author = Author::find($id);
        if ($author == NULL ) return response(['message' => 'Data not found']);
        return response()->json($author);
    }

    public function validateRequest($request){
        $request->validate([
            'name' => 'required|string'
        ]);
    }
    
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);
        $this->validateRequest($request);
        $author->update([
            'name' => $request->name,
        ]);

        return response()->json($request);

    }

   
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $author->delete();
        return response()->json($author);
    }
}
