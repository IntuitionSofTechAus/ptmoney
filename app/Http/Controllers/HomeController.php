<?php

namespace App\Http\Controllers;
Use Auth;
use Illuminate\Http\Request;

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
        if($user->remember_token != Null)
        {
          Auth::logout();
          $request->session()->flush();
          return redirect('login')->with('status','Email not verified');
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
