<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->with('roles')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('users.create',compact('roles'));
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
            //create new user
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->save();

            //assign roles to user
            if ($request->has('roles')) {
                foreach ($request->roles as $role) {
                    UserRole::firstOrCreate([
                        'user_id'=>$user->id,
                        'role_id'=>$role
                    ]);
                    
                }
            }

            session()->flash('success','User created successfully');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            session()->flash('failed','Error creating user');
            return redirect()->route('admin.users.create')->withInput();
        }
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
        $user=User::findOrFail($id);
        $roles=Role::all();

        return view('users.edit',compact('user','roles'));
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
        try {
            //Update user
            $user=User::findOrFail($id);
            $user->name=$request->name;
            $user->email=$request->email;
            //Optional: update password
            if ($request->has('password')) {
                $user->password=bcrypt($request->password);
            }
            $user->save();
            //assign roles to user
            UserRole::where('user_id',$user->id)->delete();
            if ($request->has('roles')) {
                foreach($request->roles as $role) {
                    UserRole::firstOrCreate([
                        'user_id'=>$user->id,
                        'role_id'=>$role
                    ]);
                }
            }

            session()->flash('success','User updated successfully');
            return redirect()->route('admin.users.index');
        
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('failed','Error updating user');
            return redirect()->route('admin.users.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user=User::findOrFail($id);
            $user->delete();
            session()->flash('success','User deleted successfully');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            session()->flash('failed','Error deleting user');
            return redirect()->route('admin.users.index');
        }
    }
}
