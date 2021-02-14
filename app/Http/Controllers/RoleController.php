<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index(){

        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);

    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')

        ]);
        return back();
    }

    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted', $role->name .' Deleted!');
        return back();

    }

    public function edit(Role $role){
        return view('admin.roles.edit', ['role'=>$role,
                                         'permissions'=>Permission::all(),
                                         ]);

    }

    public function update(Role $role){

        
        request()->validate([
            'name'=>['required']
        ]);

        $role->update([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        
        session()->flash('role-updated', 'Role Updated');
        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);


    }




}
