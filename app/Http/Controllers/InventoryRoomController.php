<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory_room;
use DB;

class InventoryRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Singapore');
    }

    public function inventory($id){
    	$inventory = DB::table('inventory_rooms')->join('inventories', 'inventory_id', '=', 'inventories.id')
    							->select('inventory_rooms.*', 'inventories.*')
    							->where('room_id', '=', $id)
    							->get();					;
    	return view('ajax.inventory')->with('inventory',$inventory);
    }
}
