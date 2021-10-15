<?php

namespace App\Http\Controllers;
Use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
}
