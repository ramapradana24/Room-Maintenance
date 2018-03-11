<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\User;
use Auth;
use DB;
use App\Defect;

class DefectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Singapore');
    }

    public function index()
    {
                // report

        // month available
        $months = DB::select('call bulan()');

        $years = DB::select('call tahun()');

        // report

        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                            ->where('active', 1)
                            ->count();

        $user_in = User::all()->where('id', Auth::user()->id)->first();
        if ($user_in->privilege_id == 1) {
            $defects = DB::table('defects')
                    ->join('rooms', 'room_id', '=', 'rooms.id')
                    ->join('maintenances', 'maintenance_id', '=', 'maintenances.id')
                    ->join('users', 'maintenances.user_id', '=', 'users.id')
                    ->join('inventories', 'inventory_id', '=', 'inventories.id')
                    ->select('defects.*', 'users.user_name', 'rooms.number', 'inventories.name')
                    ->where('defects.active', 1)
                    ->orderBy('defects.id', 'desc')
                    ->get();
        }else if($user_in->privilege_id == 2){
            $defects = DB::table('defects')
                    ->join('rooms', 'room_id', '=', 'rooms.id')
                    ->join('maintenances', 'maintenance_id', '=', 'maintenances.id')
                    ->join('users', 'maintenances.user_id', '=', 'users.id')
                    ->join('inventories', 'inventory_id', '=', 'inventories.id')
                    ->select('defects.*', 'users.user_name', 'rooms.number', 'inventories.name')
                    ->where('defects.active', 1)
                    ->where('maintenances.user_id', $user_in->id)
                    ->orderBy('defects.id', 'desc')
                    ->get();
        }
        
        return view('defect.defect', compact('user_in', 'unfinish_complaint', 'defects', 'months', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $defect = DB::table('defects')
            ->join('rooms', 'room_id', '=', 'rooms.id')
            ->join('maintenances', 'maintenance_id', '=', 'maintenances.id')
            ->join('users', 'maintenances.user_id', '=', 'users.id')
            ->join('inventories', 'inventory_id', '=', 'inventories.id')
            ->select('defects.*', 'users.user_name', 'rooms.number', 'inventories.name')
            ->where('defects.id', $id)
            ->first();
        return view('defect.show', compact('defect'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $defect = Defect::find($id);
        $defect->active = 0;
        $defect->save();
        return redirect('/defect');
    }

    public function fixit($id){
        $defect = Defect::find($id);
        return view('defect.fixit', compact('defect'));
    }

    public function fixing(Request $request, $id){
        $defect = Defect::find($id);
        $defect->d_status = 1;
        $defect->cost = $request->cost;
        $defect->fixed_at = now();
        $defect->save();

        return redirect('/defect');
    }
}
