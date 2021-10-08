<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class AdminController extends Controller
{
    public function index(Request $request)
    {
         return view('pages.dashboard');
    }

    public function memberList(Request $request)
    {
        $members = Member::orderBy('created_at','desc')->paginate('15');
        return view('admin.memberlist',compact('members'));
    }
}
