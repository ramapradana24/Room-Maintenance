<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use Auth;
use App\Maintenance;
use App\Maintenance_room;
use DB;
use App\Inventory_room;
use App\Defect;
use App\Complaint;
use App\Notification;

class SchedulingController extends Controller
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
        if( $user_in->privilege_id == 2 ){
            return redirect('/home');
        }else{
            $maintenance = DB::table('maintenances')
                                ->join('rooms', 'room_id', '=', 'rooms.id')
                                ->join('users', 'user_id', '=', 'users.id')
                                ->select('maintenances.*', 'rooms.number', 'users.user_name')
                                ->where('active','=', 1)
                                ->orderBy('maintenances.m_status', 'asc')
                                ->orderBy('maintenances.id', 'desc')
                                ->get();
            return view('scheduling.schedule', ['maintenance'=>$maintenance], compact('user_in', 'unfinish_complaint', 'months', 'years'));
        }
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
        $user_in = User::find(Auth::user()->id);
        if( $user_in->privilege_id == 2 ){
            return redirect('/home');
        }else if ($user_in->privilege_id == 1){
            $user = User::all()->where('id', Auth::user()->id)->first();
            $users = User::all()->where('privilege_id', '2');
            $rooms = Room::all();
            return view('scheduling.create', compact('user_in', 'users', 'rooms', 'unfinish_complaint', 'years', 'months'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::all()->where('id', Auth::user()->id)->first();
        $loop = $request->get('rooms');
        $count = count($loop);
        $detail = "inventory ini belum dicek";
        // return $request->tgl1;
        //return dd($request->all());

        $dates = array($request->tgl1, $request->tgl2, $request->tgl3, $request->tgl4, $request->tgl5, $request->tgl6);

        for($i = 0 ; $i < $request->date ; $i++){
            for($j=0 ; $j<$count ; $j++){
                // input ke table maintenance
                $maintenance = new Maintenance;
                $maintenance->user_id = $request->users;
                $maintenance->room_id = $loop[$j];
                $maintenance->s_date = $dates[$i];
                $maintenance->m_status = 0;
                $maintenance->active = 1;
                $maintenance->save();

                // input ke table maintenance rooms
                $maintenance_id = DB::table('maintenances')->max('id');
                $inventory_value = DB::table('inventory_rooms')->where('room_id', $loop[$j])->count('id');
                $inventory = Inventory_room::all()->where('room_id', 1);
                for($k=0 ; $k<$inventory_value ; $k++){
                    $maintenance_room = new Maintenance_room;
                    $maintenance_room->maintenance_id = $maintenance_id;
                    $maintenance_room->room_id = $loop[$j];
                    $maintenance_room->inventory_id = $inventory[$k]->inventory_id;
                    $maintenance_room->status = 0;
                    $maintenance_room->description = $detail;
                    $maintenance_room->save();
                }   
            }
        }

        // inserting notification for user
        $notification = new Notification;
        $notification->user_id = $request->users;
        $notification->subject = 'Jadwal Pengecekan';
        $notification->text = $user->user_name." baru saja menambahkan jadwal pengecekan untuk anda.<br>Silakan refresh beranda anda untuk melihat jadwal tersebut.";
        $notification->n_status = 0;
        $notification->active = 1;
        $notification->appear = 0;
        $notification->save();

        // inserting notification for other admin
        $admin = User::all()->where('privilege_id', 1)->count();
        for ($i=1; $i <= $admin ; $i++) { 
            if ($i == $user->id) {
                continue;
            }else{
                $notification = new Notification;
                $notification->user_id = $i;
                $notification->subject = 'Jadwal Pengecekan';
                $notification->text = $user->user_name." baru saja menambahkan jadwal pengecekan untuk pegawai. Silakan refresh beranda anda untuk melihat jadwal tersebut.";
                $notification->n_status = 0;
                $notification->active = 1;
                $notification->appear = 0;
                $notification->save();
            }
        }

        session()->flash('message', 'Sukses menambah jadwal pengecekan!');
        return redirect('/scheduling');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $maintenances = DB::table('maintenance_rooms')
                        ->join('maintenances', 'maintenance_id', '=', 'maintenances.id')
                        ->join('users', 'maintenances.user_id', '=', 'users.id')
                        ->join('inventories', 'inventory_id', '=', 'inventories.id')
                        ->join('rooms', 'maintenance_rooms.room_id', '=', 'rooms.id')
                        ->select('maintenance_rooms.*', 'rooms.number', 'inventories.name', 'users.user_name', 'maintenances.s_date', 'maintenances.m_status')
                        ->where('maintenance_id','=', $id)
                        ->get();
         // return dd($maintenances);
        return view('ajax.maintenancedetail',['maintenances' => $maintenances]);

        
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
        if( $user->privilege_id == 2 ){
            return redirect('/home');
        }else{
            $users = User::all()->where('privilege_id', '2');
            $rooms = Room::all();
            $maintenance = DB::table('maintenances')
                        ->join('rooms', 'room_id', '=', 'rooms.id')
                        ->join('users', 'user_id', '=', 'users.id')
                        ->select('maintenances.*', 'users.user_name', 'rooms.number')
                        ->where('maintenances.id', '=', $id)
                        ->first();
            // return dd($maintenance);
            return view('ajax.editSchedule', ['maintenance'=>$maintenance] ,compact('user', 'users', 'rooms', 'selected_user'));
        }
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
        // belum menampilkan error missing value
        $maintenances = Maintenance::find($id);
        
        $this->validate($request,[
            'users' => 'required',
            'rooms' => 'required',
            'tgl1' => 'required'
        ]);
        $maintenances->user_id = $request->users;
        $maintenances->s_date = $request->tgl1;
        $maintenances->room_id  = $request->rooms;
        $maintenances->save();
        session()->flash('message', 'Sukses mengedit jadwal pengecekan!');
        return redirect('/scheduling');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenances =  Maintenance::find($id);
        $maintenances->active = 0;
        $maintenances->save();
        session()->flash('deletemessage', 'Berhasil Menghapus Jadwal');
        return redirect('/scheduling');
    }

    public function maintain($id){
        $months = DB::select('call bulan()');

        $years = DB::select('call tahun()');
        $unfinish_complaint = complaint::all()->where('c_status',  '=', 0)
                            ->where('active', 1)
                            ->count();
        $user_in = User::all()->where('id', Auth::user()->id)->first();
        $inventories = DB::table('maintenance_rooms')
                            ->join('inventories', 'maintenance_rooms.inventory_id', '=', 'inventories.id')
                            ->select('*')
                            ->where('maintenance_rooms.maintenance_id', $id)
                            ->get();

        $maintenance_info = DB::table('maintenances')
                            ->join('rooms', 'room_id', '=', 'rooms.id')
                            ->join('users', 'user_id', '=', 'users.id')
                            ->select('*')
                            ->where('maintenances.id', $id)
                            ->first();
        // return dd($inventories);
        return view('scheduling.maintain', compact('user_in', 'inventories', 'unfinish_complaint', 'maintenance_info', 'years', 'months'));
    }

    public function maintain_update(Request $request, $id){

        $defect_count = 0;
        for($i = 0 ; $i < $request->count_inventory ; $i++){
            $num = $i+1;
            $invent = 'invent'.$num;
            $detail = 'detail'.$num;
            $inventid = 'inventid'.$num;
            if ($request->$invent == null){
                $request->$invent = 1;
            }
            DB::table('maintenance_rooms')
                ->where('maintenance_id', $id)
                ->where('inventory_id', $request->$inventid)
                ->update(['status' => $request->$invent, 'description' => $request->$detail, 'date' => now(), 'updated_at' => now()]);
            DB::table('maintenances')
                ->where('id', $id)
                ->update(['m_status' => 1, 'updated_at' => now()]);
            if($request->$invent == 0){
                $defect = new Defect;
                $defect->maintenance_id = $id;
                $defect->room_id = $request->room_id;
                $defect->inventory_id = $request->$inventid;
                $defect->detail = $request->$detail;
                $defect->active = 1;
                $defect->save();
                $defect_count++;
            }
        }
        $admin = User::all()->where('privilege_id', 1);
        foreach ($admin as $adm) {
            $notif = new Notification;
            $notif->user_id = $adm->id;
            $notif->subject = 'Jadwal Pengecekan';
            $notif->text = $request->username.' baru saja melakukan pengecekan pada kamar no.'.$request->room_number.' tanggal '.$request->sch_date.'<br>Anda bisa melihat hasil pengecekannya di Beranda atau Penjadwalan';
            $notif->n_status = 0;
            $notif->active = 1;
            $notif->appear = 0;
            $notif->save();

            if ($defect_count > 0) {
                $notif = new Notification;
                $notif->user_id = $adm->id;
                $notif->subject = 'Kerusakan Barang';
                $notif->text = $request->username.' baru saja baru saja menemukan kerusakan barang pada kamar no.'.$request->room_number.'<br>Anda bisa melihat barang tersebut pada menu Kerusakan';
                $notif->n_status = 0;
                $notif->active = 1;
                $notif->appear = 0;
                $notif->save();
                $defect = 0;
            }
        }
        session()->flash('message', 'Berhasil memasukkan data kedalam sistem. Terimakasih atas ketekunan anda mengecek kamar.');
        return redirect('/home');
    }
}
