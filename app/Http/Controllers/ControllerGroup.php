<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\MenuData;
use App\Menus;

class ControllerGroup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::paginate(10);
        return view('admin.group.list', compact('group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $par = "";
        $menu = Menus::orderBy('sort','asc')->get();
        // dd($menu);
        return view('admin.group.add', compact('par', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $group = new Group;
        $group->name = $request->name;
        $group->save();
        $group_id = $group->id;
        $menu = Menus::orderBy('sort','asc')->get();
        foreach($menu as $item){
            if(!empty($request->post('menu-'.$item->id ) ) ){
                $menuData = new MenuData;
                $menuData->group_id = $group_id;
                $menuData->menus_id = $item->id;
                $menuData->save();
            }
        }
        flash('Success Create Group')->success();
        return redirect('/admin/group');
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
        $par = Group::findOrfail($id);
        $menu = Menus::orderBy('sort','asc')->get();
        return view('admin.group.edit', compact('par', 'menu'));
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
        // delete menu data
        $group = MenuData::where(['group_id' =>$id])->delete();

        $group = Group::findOrfail($id);
        $group->name = $request->name;
        $group->save();
        $menu = Menus::orderBy('sort','asc')->get();
        foreach($menu as $item){
            if(!empty($request->post('menu-'.$item->id ) ) ){
                $menuData = new MenuData;
                $menuData->group_id = $id;
                $menuData->menus_id = $item->id;
                $menuData->save();
            }
        }

        flash('Success Update Group')->success();
        return redirect('/admin/group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Group $group)
    {
        $group->is_published = ! $group->is_published;
        $group->save();
        flash('Group changed successfully.')->success();
        return redirect('/admin/group');
    }
    public function destroy($id)
    {
        $group = Group::findOrfail($id);
        $group->delete();
        if($group){
            // delete menu data
            $menuData = MenuData::where(['group_id' =>$id])->delete();
            if($menuData){
                flash('Success Delete Group dan Data Menu')->success();
                return redirect('/admin/group');
            }
            flash('Success delete Group')->success();
            return redirect('/admin/group');
        }
        flash('Failed Delete Group, Data tidak ditemukan')->warning();
        return redirect('/admin/group');
    }
}
