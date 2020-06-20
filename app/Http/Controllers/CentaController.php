<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Centa;
use App\Models\Branch;


class CentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $centa = Centa::with('user','branch')->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = UserRole::where('role_id', 3)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        $users = User::whereIn('id', $go_users)->get();
        $branches = Branch::get();
        return view('admin.centa.create', compact('users','branches'));
    }

    public function loadUsersForCenta()
    {
        $userRoles = UserRole::where('role_id', 3)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        return $users = User::whereIn('id', $go_users)->get();
    }
    public function loadBranchesForCenta()
    {
        return $branches = Branch::get();
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
            'user_id'=>'required',
            'branch_id'=>'required',
        ]);

        Centa::insert([
            'user_id'=>$request['user_id'],
            'branch_id'=>$request['branch_id'],
            'name'=>$request['name'],
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
        $userRoles = UserRole::where('role_id', 3)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        $users = User::whereIn('id', $go_users)->get();
        $branches = Branch::get();
        $centa = Centa::find($id);
        return view('admin.centa.edit', compact('users','centa', 'branches'));
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
        $this->validate($request,[
            'name'=>'required',
            'user_id'=>'required',
            'branch_id'=>'required',
        ]);

        Centa::find($id)->update([
            'user_id'=>$request['user_id'],
            'branch_id'=>$request['branch_id'],
            'name'=>$request['name'],
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
        $user = Centa::find($id);
        $delete =$user->delete();

        if($delete){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
