<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //

    public function attach(Role $role){
        $permission = request('permission');

        $role->permissions()->attach($permission);
        return back();

    }

    public function detach(Role $role){
        $permission = request('permission');

        $role->permissions()->detach($permission);
        return back();
    }

    public function index(){
        return view('admin.permissions.index', [
                                         'permissions'=>Permission::all(),
                                         ]);
    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }



    public function edit(Permission $permission){
        return view('admin.permissions.edit', [
                                         'permission'=> $permission,
                                         ]);

    }

    public function update(Permission $permission){  
        request()->validate([
            'name'=>['required']
        ]);

        $permission->update([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-')
        ]);
        
        session()->flash('permission-updated', 'Permission Updated');
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions'=>$permissions]);


    }


    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted', $permission->name .' Deleted!');
        return back();

    }
    
}
