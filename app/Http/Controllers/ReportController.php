<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;
use App\Complaint;

class ReportController extends Controller
{
    public function index(Request $request){
    	// report

        // month available
        $months = DB::select('call bulan()');

        $years = DB::select('call tahun()');

        // report

    	$user_in = User::all()->where('id', Auth::user()->id)->first();
        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                            ->where('active', 1)
                            ->count();
        $year = $request->year;
    	if($request->year == ''){
    		return redirect('/home');
    	}else{
			$total_cost_complaint = DB::select('call total_cost_complaint('.$request->year.', '.$request->month.')');
			$total_cost_defect = DB::select('call total_cost_defect('.$request->year.', '.$request->month.')');
    		if($request->month == 0){
    			$report_defect = DB::table('defects')
    								->join('rooms', 'room_id', '=', 'rooms.id')
    								->join('inventories', 'inventory_id', '=', 'inventories.id')
    								->select('defects.*', 'rooms.number', 'inventories.name')
    								->where('d_status', 1)
    								->where('active', 1)
    								->whereYear('fixed_at', $request->year)
    								->get();

    			$report_complaint = DB::table('complaints')
    								->join('rooms', 'room_id', '=', 'rooms.id')
    								->join('inventories', 'inventory_id', '=', 'inventories.id')
    								->select('complaints.*', 'rooms.number', 'inventories.name')
    								->where('c_status', 1)
    								->where('active', 1)
    								->whereYear('fixed_at', $request->year)
    								->get();

    		}else{
    			$report_defect = DB::table('defects')
    								->join('rooms', 'room_id', '=', 'rooms.id')
    								->join('inventories', 'inventory_id', '=', 'inventories.id')
    								->select('defects.*', 'rooms.number', 'inventories.name')
    								->whereMonth('fixed_at', $request->month)
    								->whereYear('fixed_at', $request->year)
    								->where('d_status', 1)
    								->where('active', 1)
    								->get();

    			$report_complaint = DB::table('complaints')
    								->join('rooms', 'room_id', '=', 'rooms.id')
    								->join('inventories', 'inventory_id', '=', 'inventories.id')
    								->select('complaints.*', 'rooms.number', 'inventories.name')
    								->where('c_status', 1)
    								->where('active', 1)
    								->whereMonth('fixed_at', $request->month)
    								->whereYear('fixed_at', $request->year)
    								->get();
    		}
    		return view('report.report', compact('report_defect', 'report_complaint', 'user_in', 'unfinish_complaint', 'year', 'months', 'years', 'total_cost_defect', 'total_cost_complaint'));
    	}
    }
}
