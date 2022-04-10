<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\SkillDetail;

class ControllerSkill extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skill = Skill::orderBy('sort', 'asc')->paginate(10);
        return view('admin.skill.list', compact('skill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $par = "";
        return view('admin.skill.add', compact('par'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skill = new Skill;
        $skill->title = $request->title;
        $skill->sort = $request->sort ? $request->sort : 0;
        $skill->save();
        flash('Success Create Skill')->success();
        return redirect('/admin/skill');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill = Skill::findOrFail($id);
        $skillDetail = SkillDetail::where(['skill_id'=>$id])->paginate(10);
        return view('admin.skill.show', compact('skill', 'skillDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $par = Skill::findOrFail($id);
        return view('admin.skill.edit', compact('par'));
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
        $skill = Skill::findOrFail($id);
        $skill->title = $request->title;
        $skill->sort = $request->sort ? $request->sort : 0;
        $skill->save();
        flash('Success Update Skill')->success();
        return redirect('/admin/skill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Skill $skill)
    {
        $skill->is_published = ! $skill->is_published; 
        $skill->save();
        flash('Success Publish Skill')->success();
        return redirect('/admin/skill');
    }
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        if($skill){
            flash('Success Delete Skill')->success();
            return redirect('/admin/skill');
        }
        flash('Failed Delete Skill, Data not found!!')->success();
        return redirect('/admin/skill');
    }
}
