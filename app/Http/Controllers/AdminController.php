<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Customer;
use App\Models\ExchangeRate;
use App\Models\Beneficiary;
use App\Models\User;
use App\Models\State;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Province;
use DB;
use Mail;
use Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
         return view('pages.dashboard');
    }
    //  Member list 
    public function memberList(Request $request)
    {
        $members = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('user_id','!=',Auth::user()->id)->groupBy('receivers.sender_id')->paginate('15');
        // echo '<pre>';print_r($members);die;
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
        $member = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')-> join('receivers','senders.id','=','receivers.sender_id')->where('senders.id',$request->id)->first();
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
        $member = Sender::find($request->id);
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

    public function setting(Request $request)
    {
       if($request->method() == "GET")
        {
          $setting =  Setting::find(1);
          return view('admin.setting',compact('setting'));
        }
        $rate =  Setting::findOrNew(1);
        $rate->email_address = $request->email_address;
        $rate->save();
        return back()->with('status','Setting has been updated');
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
        $data['user_id'] = Auth::user()->id;
        $data['membership_number'] = substr($request->sender_full_name, 0, 3).rand(11111,99999);

        if($request->hasFile('docfile1')){
           $data['docfile1'] = $request->file('docfile1')->store('upload/docfile1');
        }
        if($request->hasFile('docfile2')){
            $data['docfile2'] = $request->file('docfile2')->store('upload/docfile2');
        }

        $data['approval'] = 1;
        $data['receiver_suburb']='';
        $sender = Sender::updateOrCreate(['id'=> $request->id],$data);
        $data['sender_id'] = $sender->id;

        if(Auth::user()->role == 1){
          $data['approval'] = 1;
        }else{
          $data['approval'] = 0;
        }
        Receiver::updateOrCreate(['id'=> $request->receiver_id],$data);
        return redirect('admin/list-customer')->with('success','New Customer Added Successfully !!');
    }

    public function listCustomer(){
      $members = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('user_id',Auth::user()->id)->groupBy('receivers.sender_id')->paginate('15');
      $states       = State::all();
      $provinces    = Province::all();
      return view('admin.list-customer',compact('members','states','provinces')); 
    }

    public function showCustomer($id){
        $member = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('senders.id',$id)->first();
        $is_customer = 1;
        
        return view('admin.showmember',compact('member','is_customer'));
    } 

    public function newTransaction($id){
        $member = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('receivers.id',$id)->first();
        $rate = ExchangeRate::first();
        return view('admin.transaction',compact('member','rate'));
    }

    public function transactionStore(Request $request){
        $this->validate($request, [
         'sender_id'    => 'required',
         'receiver_id' => 'required',
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
        $data['reference_id'] = '';
        $data['reference_table'] = '';
        $data['transaction_id'] = 'TRA'.rand(1111111111,9999999999);
        
        Transaction::create($data);

        if(Auth::user()->role == 1){
          return redirect('admin/receivers-list/'.$request->sender_id)->with('success','Transaction Added Successfully!!');
          
        }else{
          return redirect('user/beneficiary')->with('success','Transaction Added Successfully!!');
        }
    }

    public function listTransaction(){
        // $transaction = Transaction::where('status','waiting')->orderBy('created_at','desc')->paginate('10');
        $transaction = Transaction::with('sender','receiver')->orderBy('created_at','desc')->get();
        // echo '<pre>';print_r($transaction);die;
        return view('admin.list-transaction',compact('transaction'));
    }

    public function viewTransaction($id){
      $transactions = Transaction::with('sender','receiver')->where('receiver_id',$id)->get();
      // echo '<pre>';print_r($transaction);die;
      return view('admin.transaction_details',compact('transactions'));
    }

    public function receiversList($id){
        $beneficiary = Sender::select('senders.id as sender_id','senders.user_id','receivers.*')->join('receivers','senders.id','=','receivers.sender_id')->where('sender_id',$id)->paginate('15');
        $sender_id = $id;
        return view('admin.beneficiarylist',compact('beneficiary','sender_id'));
    }

    public function addbeneficiary($id){
        $beneficiary_count = Beneficiary::where('user_id',Auth::user()->id)->count();
        $sender = Sender::where('id',$id)->first();
        $states       = State::all();
        $provinces    = Province::all();
        return view('benificary.application_form',compact('states','beneficiary_count','provinces','sender'));
    }

    public function listTransactionByStatus($status){
      if($status != 'all'){
        $transaction = Transaction::with('sender','receiver')->where('status',$status)->orderBy('created_at','desc')->get();
      }else{
        $transaction = Transaction::with('sender','receiver')->orderBy('created_at','desc')->get();
      }       
      return view('partials.list-transactions',compact('transaction'));
    }

    public function detailTransaction($id){
      $transactions = Transaction::with('sender','receiver')->orderBy('created_at','desc')->where('id',$id)->get();

      return view('admin.transaction_details',compact('transactions'));
    }

    public function editTransaction($id){
      $transactions = Transaction::with('sender','receiver')->orderBy('created_at','desc')->where('id',$id)->get();
      return view('admin.transaction_edit',compact('transactions'));
    }

    public function transactionUpdate(Request $request){
      $transaction = Transaction::find($request->id);
      $transaction->status = $request->status;
      $transaction->note = $request->note;
      $transaction->save();
      if(Auth::user()->role == 1){
          return redirect('admin/list-transaction')->with('success','Transaction Status Updated Successfully!!');
        }
    }

    public function addNewTransaction(){
        if(Auth::user()->role == 1){
          $sender = Sender::where('approval',1)->get();
        }else{
          $sender = Sender::where('user_id',Auth::user()->id)->get();
        }
        $rate = ExchangeRate::first();
        return view('admin.new-transaction',compact('sender','rate'));
    }

    public function editMember($id){
      $member = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('senders.id',$id)->first();
        $is_customer = 0;
        
        $states       = State::all();
        $provinces    = Province::all();

        return view('admin.edit-member',compact('member','is_customer','states','provinces'));
    }

    public function sendTransactionMail($id){
      $email = Setting::find(1);
      $data = [];
      $transactions = Transaction::with('sender','receiver')->orderBy('created_at','desc')->where('id',$id)->first();

      if($transactions->is_sent == 0){
        $transactions->is_sent = 1;
        $transactions->save();
      }
      

      $data['transactions'] = $transactions;
      if(!empty($email)){
        $to = $email->email_address;
      }else{
        $to = 'test@mailinator.com';
      }
      $subject = "PTMoney - Transaction Details"; 
      Mail::send('emails.transaction', ['transactions'=>$transactions], function($message) use ($to, $subject){
        $message->from('ptmoney@gmail.com', "PTMoney");
        $message->subject($subject);
        $message->to($to);                
      });


      return redirect()->back()->with('success','Transaction Mail Send Successfully!!');
    }

}
