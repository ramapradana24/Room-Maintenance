<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Room;
use Auth;
use App\Complaint;
use App\Notification;

class ComplaintController extends Controller
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

        // count unfinish complaint
        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                            ->where('active', 1)
                            ->count();

        $user_in = User::all()->where('id', Auth::user()->id)->first();
        // get complaint data
        if ($user_in->privilege_id == 1) {
        $complaints = DB::table('complaints')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('inventories', 'inventory_id', '=', 'inventories.id')
                ->select('complaints.*', 'rooms.number', 'inventories.name')
                ->where('active', '=', 1)
                ->orderBy('complaints.c_status', 'asc')
                ->orderBy('complaints.id', 'desc')
                ->get();
        }else{
            $complaints = DB::table('complaints')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('inventories', 'inventory_id', '=', 'inventories.id')
                ->select('complaints.*', 'rooms.number', 'inventories.name')
                ->where('active', '=', 1)
                ->where('user_id', $user_in->id)
                ->orderBy('complaints.c_status', 'asc')
                ->orderBy('complaints.id', 'desc')
                ->get();
        }
        
        return view('complaint.complaint', ['complaints' => $complaints], compact('user_in', 'unfinish_complaint', 'months', 'years'));            
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months = DB::select('call bulan()');

        $years = DB::select('call tahun()');
        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                        ->where('active', 1)
                        ->count();
        $user_in = User::all()->where('id', Auth::user()->id)->first();
        
        $rooms = Room::all();
        return view('complaint.create', compact('rooms', 'user_in', 'unfinish_complaint', 'years', 'months'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count_user = User::all()->count();
        
        $complaint = new Complaint;
        $user = User::all()->where('id', Auth::user()->id)->first();
        $complaint->user_id = $user->id;
        $complaint->room_id = $request->room;
        $complaint->inventory_id = $request->inventory;
        $complaint->detail = $request->detail;
        $complaint->active = 1;
        $complaint->c_status = 0;
        $complaint->save();

        for ($i = 1; $i <= $count_user; $i++) { 
            if($i == $user->id){
                continue;
            }else{
                $notification = new Notification;
                $notification->user_id = $i;
                $notification->subject = 'Pengaduan';
                $notification->text = $user->user_name." baru saja menambah pengaduan baru. <br>Silakan lihat pada menu Pengaduan";
                $notification->n_status = 0;
                $notification->active = 1;
                $notification->appear = 0;
                $notification->save();
            }
        }
        session()->flash('message', 'Sukses menambah pengaduan!');
        return redirect('/complaint');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all()->where('id', Auth::user()->id)->first();
        $complaint = DB::table('complaints')
                        ->join('rooms', 'room_id', '=', 'rooms.id')
                        ->join('users', 'user_id', '=', 'users.id')
                        ->join('inventories', 'inventory_id', '=', 'inventories.id')
                        ->select('complaints.*', 'rooms.number', 'inventories.name', 'users.user_name')
                        ->where('complaints.id', $id)
                        ->orderBy('complaints.id', 'desc')
                        ->first();
        // return dd($complaint)                        ;
        return view('complaint.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::all()->where('id', Auth::user()->id)->first();
        $users = User::all();
        $inventories = DB::table('complaints')
                        ->join('rooms', 'complaints.room_id', '=','rooms.id')
                        ->join('inventory_rooms', 'complaints.room_id', '=', 'inventory_rooms.room_id')
                        ->join('inventories', 'inventory_rooms.inventory_id', '=', 'inventories.id')
                        ->select('*')
                        ->where('complaints.id', $id)
                        ->get();
        
        $rooms = Room::all();
        $complaint = DB::table('complaints')
                            ->join('rooms', 'room_id', '=', 'rooms.id')
                            ->join('inventories', 'inventory_id', '=', 'inventories.id')
                            ->join('users', 'user_id', '=', 'users.id')
                            ->select('complaints.*', 'rooms.number', 'inventories.name', 'users.user_name')
                            ->where('complaints.id', $id)
                            ->first();
        // return dd($complaint);
        return view('complaint.edit', compact('complaint', 'rooms', 'user', 'inventories', 'users'));

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
        $user = User::all()->where('id', Auth::user()->id)->first();
        // return dd($request);
        $complaint = Complaint::find($id);
        if ($user->privilege_id == 1) {
            $complaint->user_id = $request->user;
        }
        $complaint->room_id = $request->rooms;
        $complaint->inventory_id = $request->inventory;
        $complaint->detail = $request->detail;
        $complaint->save();
        session()->flash('message', 'Sukses mengedit pengaduan!');
        return redirect('/complaint');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint =  Complaint::find($id);
        $complaint->active = 0;
        $complaint->save();
        return redirect('/complaint');
    }

    public function fixit($id){
        $complaint = Complaint::find($id);
        return view('complaint.fixit', compact('complaint'));
    }

    public function fixing(Request $request, $id){
        $complaint = Complaint::find($id);
        $complaint->c_status = 1;
        $complaint->cost = $request->cost;
        $complaint->fixed_at = now();
        $complaint->save();

        return redirect('/complaint');
    }

}
