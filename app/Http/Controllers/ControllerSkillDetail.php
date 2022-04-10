<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SkillDetail;
use App\Skill;

class ControllerSkillDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skill = SkillDetail::orderBy('sort', 'asc')->paginate(10);
        return view('admin.skillDetail.list', compact('skill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $par = "";
        $skill = Skill::where(['is_published'=> true])->get();
        return view('admin.skillDetail.add', compact('par', 'skill'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'skill_id' => 'required',
        ]);
        $skill = new SkillDetail;
        $skill->title = $request->title;
        $skill->skill_id = $request->skill_id;
        $skill->sort = $request->sort ? $request->sort : 0;
        $skill->save();
        flash('Success Create Sub Skill')->success();
        return redirect('/admin/sub_skill');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $par = SkillDetail::findOrFail($id);
        $skill = Skill::where(['is_published'=> true])->get();
        return view('admin.skillDetail.edit', compact('par', 'skill'));
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
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'skill_id' => 'required',
        ]);
        $skill = SkillDetail::findOrFail($id);
        $skill->title = $request->title;
        $skill->skill_id = $request->skill_id;
        $skill->sort = $request->sort ? $request->sort : 0;
        $skill->save();
        flash('Success Update Sub Skill')->success();
        return redirect('/admin/sub_skill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(SkillDetail $skilldetail)
    {
        $skilldetail->is_published = ! $skilldetail->is_published; 
        $skilldetail->save();
        flash('Success Publish Sub Skill')->success();
        return redirect('/admin/sub_skill');
    }
    public function destroy($id)
    {
        $skill = SkillDetail::findOrFail($id);
        $skill->delete();
        if($skill){
            flash('Success Delete Sub Skill')->success();
            return redirect('/admin/sub_skill');
        }
        flash('Failed Delete Sub Skill, Data not found!!')->success();
        return redirect('/admin/sub_skill');
    }
}
