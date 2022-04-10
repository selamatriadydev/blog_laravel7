<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;

class ControllerProject extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::orderBy('sort', 'asc')->paginate(10);
        return view('admin.project.list', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $par = "";
        $category = ProjectCategory::where(['is_published'=> 1])->get();
        return view('admin.project.add', compact('par', 'category'));
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
            'image' => 'required',
            'category_id' => 'required',
        ]);
        $project = new Project;
        $project->title = $request->title;
        $project->category_id = $request->category_id;
        $project->file_path = $request->file('image')->store('project');
        $project->sort = $request->sort ? $request->sort : 0;
        $project->is_published = false;
        $project->save();
        flash('Success Create Project')->success();
        return redirect('/admin/project');
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
        $par = Project::findOrFail($id);
        $category = ProjectCategory::where(['is_published'=> 1])->get();
        return view('admin.project.edit', compact('par', 'category'));
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
            'category_id' => 'required',
        ]);
        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->category_id = $request->category_id;
        $project->file_path =  $request->file('image') ? $request->file('image')->store('project') : $project->file_path;
        $project->sort = $request->sort ? $request->sort : 0;
        $project->save();
        flash('Success Create Project')->success();
        return redirect('/admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Project $project)
    {
        $project->is_published = ! $project->is_published; 
        $project->save();
        flash('Success Publish')->success();
        return redirect('/admin/project');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        if($project){
            flash('Success Delete Project')->success();
            return redirect('/admin/project');
        }
        flash('Failed Delete Project, Data not found!!')->success();
        return redirect('/admin/project');
    }
}
