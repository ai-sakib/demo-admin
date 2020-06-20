<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Centa;
use App\Models\Branch;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'attendance'=>Attendance::with('centa')->get()
        ]); 
    }

    public function loadCentaForAttendance()
    {
        return $centa = Centa::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centa = Centa::get();
        return view('admin.attendance.create', compact('centa'));
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
            'centa_id'=>'required',
            'watch_party'=>'required',
            'total_attendance'=>'required',
            'first_timers'=>'required',
            'new_believers'=>'required',
            'testimonies'=>'required',
        ]);
        $attendance = new Attendance;
        $attendance->fill($request->all());
        $attendance->date = date('Y-m-d');
        $attendance->save();

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
        $attendance = Attendance::find($id);
        $centa = Centa::get();
        return view('admin.attendance.edit', compact('centa', 'attendance'));
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
            'centa_id'=>'required',
            'watch_party'=>'required',
            'total_attendance'=>'required',
            'first_timers'=>'required',
            'new_believers'=>'required',
            'testimonies'=>'required',
        ]);

        $attendance = Attendance::find($id);
        $attendance->fill($request->all());
        $attendance->date = date('Y-m-d');
        $attendance->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Attendance::find($id);
        $delete =$user->delete();

        if($delete){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
