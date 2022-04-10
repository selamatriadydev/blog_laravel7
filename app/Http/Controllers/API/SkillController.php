<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Skill;
use App\Http\Resources\SkillResource;
use App\SkillDetail;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $skill = Skill::with(['apiSkillDetail'])->where(['is_published'=>true])->get();
        $skill = Skill::where(['is_published'=>true])->get();
        return SkillResource::collection($skill);
    }
    public function sub_skill($id)
    {
        // $skill = Skill::with(['apiSkillDetail'])->where(['is_published'=>true])->get();
        $skill = SkillDetail::where(['is_published'=>true, 'skill_id'=> $id])->get();
        return $skill;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
