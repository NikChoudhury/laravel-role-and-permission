<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Module;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Gate;
class RoleController extends Controller
{
    // assign roles
    public function __construct()
    {
        $this->middleware('can:view_role',     ['only' => ['index', 'show','view']]);
        $this->middleware('can:create_role',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_role',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_role',   ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        $modules=Module::all();
        return view('roles.create',compact('permissions','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
            ]);
           
            // echo "<pre>";
            // print_r($request->all());
            // die();
            $role = Role::create([
                'name'=> $request['name'],
            ]);

            if ($request->has('permissions')) {
                $role->permissions()->createMany($request['permissions']);
            }
            session()->flash('success',__('Role created successfully'));

            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if (isset($role)) {
            $permissions=Permission::all();
            $modules=Module::all();  
            return view('roles.edit',compact('role','permissions','modules'));
        }else{
            session()->flash('failed',__('Data not Found!!!'));
            return redirect()->route('admin.role.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $role=Role::findOrFail($id);
            $request->validate([
                'name' => 'required|unique:roles,name,'.$id,
            ]);
            $role->update([
                'name'=>$request['name'],
            ]);

            RolePermission::where('role_id',$id)->delete();
            if($request->has('permissions'))
            {
                $role->permissions()->createMany($request['permissions']);
            }
            session()->flash('success',__('Role successfully Updated !!'));
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->delete();
            $role->delete();
            session()->flash('success',__('Data deleted successfully'));
            return redirect()->route('admin.roles.index');

        } catch (\Throwable $th) {
            session()->flash('failed',__('Something Went wrong !!!'));
            return redirect()->route('admin.roles.index');
        }
    }
}
