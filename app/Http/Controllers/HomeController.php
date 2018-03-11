<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Maintenance;
use Auth;
use DB;
use App\Complaint;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Singapore');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // count complaint
        $count_complaint = DB::table('complaints')
                            ->select('complaints.*')
                            ->where('active', '=', 1)
                            ->count();

        // count checked room
        $count_checked_room = DB::table('maintenances')
                                ->select('maintenances.id')
                                ->where('m_status', '=', 1)
                                ->where('active', '=', 1)
                                ->count();

        // count unchecked room
        $count_unchecked_room = DB::table('maintenances')
                                ->select('maintenances.id')
                                ->where('m_status', '=', 0)
                                ->where('active', '=', 1)
                                ->count();

        // count number of complaint unfinish
        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                                    ->where('active', 1)
                                    ->count();

        // report

        // month available
        $months = DB::select('call bulan()');

        $years = DB::select('call tahun()');

        // report
        $user_in = User::all()->where('id', Auth::user()->id)->first();
        $complaints = DB::table('complaints')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('inventories', 'inventory_id', '=', 'inventories.id')
                ->select('complaints.*', 'rooms.number', 'inventories.name')
                ->where('active', '=', 1)
                ->orderBy('complaints.c_status', 'asc')
                ->orderBy('complaints.id', 'desc')
                ->get();
        if( $user_in->privilege_id == 1 ){
            // showing data of maintenances
            $maintenance = DB::table('maintenances')
                                ->join('rooms', 'room_id', '=', 'rooms.id')
                                ->join('users', 'user_id', '=', 'users.id')
                                ->select('maintenances.*', 'rooms.number', 'users.user_name')
                                ->where('active','=', 1)
                                ->orderBy('maintenances.m_status', 'asc')
                                ->orderBy('maintenances.id', 'desc')
                                ->get();
            return view('home', ['maintenance' => $maintenance], compact('user_in', 'count_complaint', 'count_checked_room', 'count_unchecked_room', 'complaints', 'unfinish_complaint', 'years', 'months'));
        }else if( $user_in->privilege_id == 2 ){
            $user_maintenance = DB::table('maintenances')
                                    ->join('rooms', 'room_id', '=', 'rooms.id')
                                    ->select('maintenances.*', 'rooms.number')
                                    ->where('active','=', 1)
                                    ->where('user_id', $user_in->id)
                                    ->orderBy('maintenances.m_status', 'asc')
                                    ->orderBy('maintenances.id', 'desc')
                                    ->get();
            return view('home', ['user_maintenance' => $user_maintenance ] , compact('user_in', 'count_complaint', 'count_checked_room', 'count_unchecked_room', 'complaints', 'unfinish_complaint', 'years', 'months'));
        }
        
        
    }
}

