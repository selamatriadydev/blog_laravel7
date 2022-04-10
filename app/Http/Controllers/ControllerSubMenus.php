<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;
class ControllerSubMenus extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $menus = Menus::where(['parent_id'=> $id])->paginate(10);
        $IdParent = $id;
        return view('admin.submenus.list', compact('menus', 'IdParent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = "";
        $parent = Menus::where(['parent_id'=> 0])->get();
        return view('admin.submenus.add', compact('menus', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menus = new Menus;
        $menus->title = $request->title;
        $menus->link = empty($request->link) ? '#' : $request->link;
        $menus->parent_id = empty($request->parent_id) ? 0 :$request->parent_id;
        $menus->sort = 0;
        $menus->save();
        flash('Success Create Sub Menu')->success();
        return redirect('/admin/submenus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = Menus::where(['parent_id'=> 0])->get();
        $menus = Menus::findOrFail($id);
        // dd($menus);
        return view('admin.submenus.edit', compact('menus', 'parent'));
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
        $menus = Menus::findOrFail($id);
        $menus->title = $request->title;
        $menus->link = $request->link;
        $menus->parent_id = empty($request->parent_id) ? 0 :$request->parent_id;
        $menus->sort = 0;
        $menus->save();
        flash('Success Update Sub Menu')->success();
        return redirect('/admin/submenus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menus = Menus::findOrFail($id);
        $menus->delete();
        if($menus){
            flash('Success Delete Sub Menu')->success();
        }else{
            flash('Menu Not Found')->success();
        }
        return redirect('/admin/submenus');
    }
}
