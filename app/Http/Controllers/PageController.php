<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;

class PageController extends Controller
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
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        return abort(404);
    }
    public function home()
    {
        if(Auth::user())
        {
            $user = Auth::user();
            if($user->role == 1)
            {
              return redirect('admin');
            }
            else
            {
              return redirect('user');
            }
        }
       return view('welcome');
    }
}
