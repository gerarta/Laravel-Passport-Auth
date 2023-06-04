<?php

namespace App\Http\Controllers;

use App\Models\skill;
use Illuminate\Http\Request;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillCollection;

class SkillController extends Controller
{
    
    public function index()
    {
        $data = skill::paginate(20);
        return SkillResource::collection($data);
    }

 
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string',
        ]);
        skill::create([
            'name' => $request->name,
        ]);

        return response()->json($data);
    }

    
    public function show(string $id)
    {
        $data = skill::find($id);
        return new SkillResource($data);
    }

  
    public function update(Request $request,skill $skill)
    {
        $request->validate([
            'name' => 'required|string',
        ]); 
        $skill->update($request->all());
        return response()->json($skill);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(skill $skill)
    {
        $skill->delete();
        return response()->json("skill succesfuly deleted");
    }
}
