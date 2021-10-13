<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\ExchangeRate;
use App\Models\Beneficiary;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
         return view('pages.dashboard');
    }
//  Member list 
    public function memberList(Request $request)
    {
        $members = Member::orderBy('created_at','desc')->paginate('15');
        return view('admin.memberlist',compact('members'));
    }

//  Users List
    public function usersList(Request $request)
    {
        $users = User::orderBy('created_at','desc')->where('role',2)->paginate('15');
        return view('admin.userlist',compact('users'));
    }

// Show member detail
    public function showMember(Request $request)
    {
        $member = Member::find($request->id);
        return view('admin.showmember',compact('member'));
    }
//public function approval
    public function approval(Request $request)
    {
       if($request->decline)
       {
         $approval=2;
       }
       else
       {
         $approval=1;
       }
        $member = Member::find($request->id);
        $member->approval=$approval;
        if($member->save())
        {
            return redirect()->route('member.list')->with('status','Status Updated Succesful');
        }
        else
        {
            return rediret()->back()->with('status','Something wrong went');
        }
    }
// Exchange rate functionality
    public function exchangeRate(Request $request)
    {
       if($request->method() == "GET")
        {
          $rate =  ExchangeRate::find(1);
          return view('admin.exchange_rate',compact('rate'));
        }
        $rate =  ExchangeRate::findOrNew(1);
        $rate->exchange_rate = $request->exchange_rate;
        $rate->save();
        return back()->with('status','ExchangeRate has been changes');
    }
}
