<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ControllerUzer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::paginate(10);
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = "";
        $isUpdate = 0;
        $group = Group::where(['is_published'=> true])->get();
        return view('admin.user.add', compact('user', 'group', 'isUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id ? $request->group_id : 5;
        if($request->group_id == 4){
            $user->is_admin = 1;
        }
        $user->save();

        flash('User created successfully.')->success();
        return redirect('/admin/uzer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isUpdate = 1;
        $user = User::findOrFail($id);
        $group = Group::where(['is_published'=> true])->get();
        return view('admin.user.edit', compact('user', 'group', 'isUpdate'));
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        // cek email 
        if( User::where('email', $request->email)->whereNotIn('id', [$id])->count() > 0){
            flash('Email Already.')->warning();
            return redirect('/admin/uzer');
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $this->validate($request, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id ? $request->group_id : $user->group_id;
        if($request->group_id == 4){
            $user->is_admin = 1;
        }
        $user->save();

        flash('User updated successfully.')->success();
        return redirect('/admin/uzer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if($user){
            flash('User deleted successfully.')->success();
            return redirect('/admin/uzer');
        }
        flash('User updated fauiled, user not found!!.')->success();
        return redirect('/admin/uzer');
    }
}
