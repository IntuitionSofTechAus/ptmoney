<?php

namespace App\Http\Controllers;
Use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sender;
use App\Models\Receiver;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user=Auth::user();
        if($user->is_verified != 1)
        {
          Auth::logout();
          $request->session()->flush();
          return redirect('login')->with('status','Your Email Account is  Not Verified');
        }
        if($user->role == 1)
        {
            return redirect('admin');
        }
        else
        {
            return redirect('user');
        }

        return view('pages.dashboard');
    }

    public function getReceiver($id){
        $receiver = Receiver::where('sender_id',$id)->get();
        $res = "<option>Select Receiver</option>";
        foreach($receiver as $r){
            $res .= "<option value='".$r->id."'>".$r->receiver_full_name."</option>";
        }

        return $res;
    }

    public function getReceiverDetail($id , $value){
        $receiver = Receiver::where('id',$id)->pluck($value)->first();
        return $receiver;
    }

    public function getSenderDetail($id , $value){
        $sender = Sender::where('id',$id)->pluck($value)->first();
        return $sender;
    }
}
