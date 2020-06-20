<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;


class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index()
    {
        return $users = User::with('userRole', 'userRole.role')->paginate(20);
    }
    public function loadUsersForBranch()
    {
        $userRoles = UserRole::where('role_id', 2)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        return $users = User::whereIn('id', $go_users)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'role_id'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required| confirmed | max: 20',
        ]);

        $user_id = User::insertGetId([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'password'=> Hash::make($request['password']),
        ]);

        UserRole::insert([
            'user_id'=>$user_id,
            'role_id'=>$request['role_id'],
        ]);

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
        $roles = Role::get();
        $user = User::find($id);
        return view('admin.user.edit', compact('roles','user'));
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
        $user = User::find($id);
        $this->validate($request,[
            'name'=>'required',
            'role_id'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'sometimes| confirmed | max: 20',
        ]);

        $user->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ]);

        if($request->password){
            $user->password = Hash::make($request['password']);
            $user->save();
        }

        UserRole::where('user_id',$id)->update([
            'role_id'=>$request['role_id'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $delete =$user->delete();
        $delete2 = UserRole::where('user_id',$id)->delete();

        if($delete && $delete2){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
