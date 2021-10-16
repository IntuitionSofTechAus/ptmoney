<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Customer;
use App\Models\ExchangeRate;
use App\Models\Beneficiary;
use App\Models\User;
use App\Models\State;
use App\Models\Transaction;
use App\Models\Province;
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
        $is_customer = 0;
        return view('admin.showmember',compact('member','is_customer'));
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

    public function newCustomer(){
        $states       = State::all();
        $provinces    = Province::all();
        return view('admin.add-customer',compact('states','provinces')); 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
         'sender_full_name'    => 'required|min:3',
         'dob'                 => 'required',
         'telephone'           => 'required|numeric|min:10',
         'sender_address'      => 'required|min:3',
         'sender_suburb'       => 'required',
         'sender_state'        => 'required',
         'sender_postcode'     => 'required',
         'occupation'          => 'required',
         'political'           => 'required',
         'presence'            => 'required',
         'receiver_full_name'  => 'required|min:3',
         'receiver_address'    => 'required|min:3',
         'receiver_state'      => 'required',
         'receiver_postcode'   => 'required',
         'bank_name'           => 'required',
         'accont_number'       => 'required|numeric',
         'branch'              => 'required',
         'signed'              => 'required',
         'name'                => 'required',
         'date'                => 'required',
         'document1'           => 'required',
         'docfile1'            => 'required',
         'document2'           => 'required',
         'docfile2'            => 'required',
         'doc_expiry1'         => 'required',
         'doc_expiry2'         => 'required',
         'contact_number'      => 'required|numeric|min:10',
         'province'            => 'required',
        ]);

        $folderPath = public_path('upload/');        
        $image_parts = explode(";base64,", $request->signed);              
        $image_type_aux = explode("image/", $image_parts[0]);           
        $image_type = $image_type_aux[1];           
        $image_base64 = base64_decode($image_parts[1]);
        $image= uniqid() . '.'.$image_type;           
        $file = $folderPath . $image;
        file_put_contents($file, $image_base64);
        $data = $request->all();
        $data['signed']  = $image;
        $data['membership_number'] = substr($request->sender_full_name, 0, 3).rand(11111,99999);
        if($request->hasFile('docfile1')){
           $data['docfile1'] = $request->file('docfile1')->store('upload/docfile1');
        }
        
        if($request->hasFile('docfile2')){
            $data['docfile2'] = $request->file('docfile2')->store('upload/docfile2');
        }

        $data['receiver_suburb']='';
        Customer::updateOrCreate(['id'=> $request->id],$data);
        return redirect('admin/list-customer')->with('success','New Customer Added Successfully !!');
    }

    public function listCustomer(){
      $members = Customer::orderBy('created_at','desc')->paginate('15');
      $states       = State::all();
      $provinces    = Province::all();
      return view('admin.list-customer',compact('members','states','provinces')); 
    }

    public function showCustomer($id){
        $member = Customer::find($id);
        $is_customer = 1;
        return view('admin.showmember',compact('member','is_customer'));
    } 

    public function newTransaction($id){
        $member = Customer::find($id);
        $rate = ExchangeRate::first();
        return view('admin.transaction',compact('member','rate'));
    }

    public function transactionStore(Request $request){
        $this->validate($request, [
         'reference_id'    => 'required',
         'reference_table' => 'required',
         'amount'           => 'required|numeric',
         'rate'      => 'required|numeric',
         'fee'       => 'required|numeric',
         'total_payable'        => 'required|numeric',
         'receivable_amount'     => 'required|numeric',
         'aganet_ref'          => 'required',
         'purpose'           => 'required'
        ]);
        $data = $request->all();
        $data['status'] = 'waiting';
        $data['transaction_id'] = strtoupper(substr($request->sender_full_name, 0, 1)).rand(11111111,99999999);
        
        Transaction::create($data);
        return redirect('admin/list-customer')->with('success','Transaction Added Successfully!!');
    }

    public function listTransaction(){
        $transaction = Transaction::where('status','waiting')->orderBy('created_at','desc')->paginate('10');
        return view('admin.list-transaction',compact('transaction'));
    }
}
