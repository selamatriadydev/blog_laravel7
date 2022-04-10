<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectCategory;

class ControllerProjectCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ProjectCategory::orderBy('sort', 'asc')->paginate(10);
        return view('admin.project_category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $par = "";
        return view('admin.project_category.add', compact('par'));
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
            'link' => 'required',
        ]);
        $category = new ProjectCategory;
        $category->title = $request->title;
        $category->link = $request->link;
        $category->sort = $request->sort ? $request->sort : 0;
        $category->is_published = false;
        $category->save();
        flash('Success Create')->success();
        return redirect('/admin/category_project');
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
        $par = ProjectCategory::findOrFail($id);
        return view('admin.project_category.edit', compact('par'));
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
            'link' => 'required',
        ]);
        $category = ProjectCategory::findOrFail($id);
        $category->title = $request->title;
        $category->link = $request->link;
        $category->sort = $request->sort ? $request->sort : 0;
        $category->is_published = false;
        $category->save();
        flash('Success Create')->success();
        return redirect('/admin/category_project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(ProjectCategory $projectcategory)
    {
        $projectcategory->is_published = ! $projectcategory->is_published; 
        $projectcategory->save();
        flash('Success Publish')->success();
        return redirect('/admin/category_project');
    }
    public function destroy($id)
    {
        $category = ProjectCategory::findOrFail($id);
        $category->delete();
        if($category){
            flash('Success Delete')->success();
            return redirect('/admin/category_project');
        }
        flash('Failed Delete, Data not found!!')->success();
        return redirect('/admin/category_project');
    }
}
