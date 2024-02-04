<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function show($id){
        abort('404');
   }
    public function index()
    {
        $roles = Role::get();
        return view('role.index')->with('roles', $roles);
        if(\Auth::user()->can('role list')) {
            $roles = Role::get();
            return view('role.index')->with('roles', $roles);
        }
        else
        {
            abort('405');
        }

    }

    public function create()
    {


        if(\Auth::user()->can('role create')){
            $permissions = Permission::all()->pluck('name', 'id')->toArray();
            return view('role.create', ['permissions' => $permissions]);
        }
        else
        {
            abort('405');
        }

    }

    public function store(Request $request)
    {
       // dd($request->all());

            $role = Role::where('name', '=', $request->name)->first();
            if(isset($role))
            {
                return redirect()->back()->with('error', __('The Role has Already Been Taken.'));
            }
            else
            {
                $this->validate(
                    $request, [
                                'name' => 'required|max:100|unique:roles,name,NULL,id',
                                'permissions' => 'required',
                            ]
                );

                $name             = $request['name'];
                $role             = new Role();
                $role->name       = $name;
                // $role->created_by = \Auth::user()->creatorId();
                $permissions      = $request['permissions'];
                $role->save();

                foreach($permissions as $permission)
                {
                    $p    = Permission::where('id', '=', $permission)->firstOrFail();
                    $role = Role::where('name', '=', $name)->first();
                    $role->givePermissionTo($p);
                }

                return redirect()->route('role.index')->with('success', 'Role successfully created.');

            }


    }

    public function edit(Role $role)
    {


//        $permissions = Permission::all()->pluck('name', 'id')->toArray();
//        return view('role.edit', compact('role', 'permissions'));
        if(\Auth::user()->can('role edit'))
        {

            $permissions = Permission::all()->pluck('name', 'id')->toArray();
            return view('role.edit', compact('role', 'permissions'));
        }
        else
        {
            abort('405');
        }


    }

    public function update(Request $request, Role $role)
    {


            $input       = $request->except(['permissions']);
            $permissions = $request['permissions'];
            $role->fill($input)->save();

            $p_all = Permission::all();

            foreach($p_all as $p)
            {
                $role->revokePermissionTo($p);
            }

            foreach($permissions as $permission)
            {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);
            }

            return redirect()->route('role.index')->with('success', 'Role successfully updated.');


    }

    public function destroy(Role $role)
    {

        if(\Auth::user()->can('role delete'))
        {
            $role->delete();

            return redirect()->route('role.index')->with(
                'success', 'Role successfully deleted.'
            );
        }
        else
        {
           abort('405');
        }


    }
}
