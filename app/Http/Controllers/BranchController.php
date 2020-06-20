<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Branch;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Branch::with('user')->latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = UserRole::where('role_id', 2)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        $users = User::whereIn('id', $go_users)->get();
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
        ]);

        $branch = new Branch;
        $branch->fill($request->all())->save();

        UserRole::where('user_id', $request->user_id)->update(['branch_set'=> 1]);
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
        $userRoles = UserRole::where('role_id', 2)->where('branch_set', 0)->get();
        $go_users = array();
        if(!empty($userRoles)){
            foreach ($userRoles as $key => $value) {
                array_push($go_users, $value->user_id);
            }
        }
        $users = User::whereIn('id', $go_users)->get();
        $branch = Branch::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'user_id'=>'required',
        ]);

        $branch = Branch::find($id);
        UserRole::where('user_id', $request->user_id)->update(['branch_set'=> 1]);
        if($branch->user_id != $request->user_id){
            UserRole::where('user_id', $branch->user_id)->update(['branch_set'=> 0]);
        }
        $branch->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        $delete = $branch->delete();
        UserRole::where('user_id', $branch->user_id)->update(['branch_set'=> 0]);

        if($delete){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
