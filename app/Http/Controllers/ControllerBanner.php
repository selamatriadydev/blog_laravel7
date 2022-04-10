<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class ControllerBanner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('sort', 'asc')->paginate(10);
        return view('admin.banner.list', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = "";
        return view('admin.banner.add', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner;
        $banner->title = $request->title;
        $banner->body = $request->body;
        $banner->file_path = $request->file('image') ? $request->file('image')->store('images') : '';
        $banner->sort = $request->sort ? $request->sort : 0;
        $banner->save();
        flash('Success Create Banner')->success();
        return redirect('/admin/banner');
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
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
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
        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->body = $request->body;
        if($request->file('image')){
            $banner->file_path = $request->file('image')->store('images');
        }
        $banner->sort = $request->sort ? $request->sort : 0;
        $banner->save();
        flash('Success Update Banner')->success();
        return redirect('/admin/banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Banner $banner)
    {
        $banner->is_published = ! $banner->is_published; 
        $banner->save();
        flash('Success Publish Banner')->success();
        return redirect('/admin/banner');
    }
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        if($banner){
            flash('Success Delete Banner')->success();
            return redirect('/admin/banner');
        }
        flash('Failed Delete Banner, Data not found!!')->success();
        return redirect('/admin/banner');
    }
}
