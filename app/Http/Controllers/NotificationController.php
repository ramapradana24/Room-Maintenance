<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use DB;
use App\Complaint;
use App\User;
use Auth;

class NotificationController extends Controller
{
    public function index(){
        $user_in = User::all()->where('id', Auth::user()->id)->first();
        // $notifications = Notification::all()
        //             ->where('user_id', $user_in->id)
        //             ->where('active', 1)
        //             ->get();

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
        return view('notification.notification', compact('user_in', 'unfinish_complaint', 'months', 'years'));
    }

    public function show_notification($id){
    	$notification = Notification::limit(10)
    						->where('user_id', $id)
                            ->where('active', 1)
    						->orderBy('id', 'desc')
    						->get();

    	$count_notif = count($notification);
    	if($count_notif > 0){
    		$notifications = '';
	    	foreach ($notification as $notif) {
	    		$notifications = $notifications."
	    		<li>
					<p class='dropdown-item'>
						<strong>".$notif->subject."</strong><br>
						<small>".$notif->text."</small>
					</p>
				</li>";
	    	}
            // $notifications = $notifications."
            //     <li>
            //         <p class='dropdown-item'>
            //             <a href='/notification'>Klik disini untuk melihat lebih banyak</a>
            //         </p>
            //     </li>";
    	}else{
    		$notifications = "
    		<li>
				<a href='' class='dropdown-item'>
					No Notification Found
				</a>
			</li>
    		";
    	}


    	$unseen_notif = Notification::all()->where('n_status', 0)->count();
    	return $notifications;
    }

    public function unseen_notif($id){
    	$unseen_notif = Notification::all()->where('n_status', 0)
    					->where('user_id', $id)
    					->count();
    	if ($unseen_notif > 0) {
    		return $unseen_notif;
    	} else {
    		return null;
    	}
    	
    }

    public function update_notif($id){
    	DB::table('notifications')
    		->where('user_id', $id)
    		->update(['n_status' => 1]);
    }

    public function load_last($id){
    	$last_notif = DB::table('notifications')->where('user_id', $id)
    					->where('n_status', 0)
    					->where('active', 1)
    					->where('appear', 0)
    					->select('*')
    					->get();
    	$pop_notif = '';
    	foreach ($last_notif as $notif) {
    		$pop_notif = $pop_notif."
    			<div class='alert alert_default'>
	    			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<p><strong>". $notif->subject ."</strong></p>
					<small><em>". $notif->text ."</em></small>
    			</div>
    		";
    	}

    	DB::table('notifications')
    		->where('appear', 0)
    		->update(['appear' => 1]);

    	return $pop_notif;
    }
}
