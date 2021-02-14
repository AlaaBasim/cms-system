<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    //

    public function index(){
        $users = User::all();
        return view('admin.users.index', ["users"=>$users]);

    }

    public function show(User $user){

        return view('admin.users.profile', ['user'=>$user, 'roles'=>Role::all()]);

    }

    public function update(User $user){
       $inputs = request()->validate([
            'name' =>['required', 'string'],
            'email'=> ['required', 'email'],
            'avatar'=> ['file'],
            'password' => ['confirmed']

       ]);

       if(request('avatar')){
           $inputs['avatar'] = request('avatar')->store('images');
       }
       $user->update($inputs);

       return back();

    }

    public function destroy(User $user){
        $user->delete();
        session()->flash('user-deleted', 'user was deleted');
        return back();
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }

}
