<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use DateTime;
use App\Privilege;


use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Singapore');
    }


    public function index(){
    	// $user = User::all()->where('id',Auth::user()->id)->first();
    	// $dateuser = User::select('dateofbirth')->where('id',Auth::user()->id)->first();
    	// $textdate = date("M jS, Y", strtotime($dateuser->dateofbirth));
    	// $userage = date("Y") - (int)substr($user->dateofbirth, 0, 4);
    	// return view('profile', compact('user', 'userage', 'textdate'));	   	
    }
}
