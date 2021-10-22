<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\State;
use App\Models\Member;
use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Beneficiary;
use App\Models\Province;

class MemberController extends Controller
{
    
    //Add new member form after login
    public function index()
    {   
        $member_count = Sender::where('user_id',Auth::user()->id)->count();
        $member       = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('user_id',Auth::user()->id)->first();
        $states       = State::all();
        $provinces    = Province::all();
        return view('member.application_form',compact('member_count','member','states','provinces')); 
    }

    //Store member detail
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
           'acceptance'          => 'required',
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

        $data['receiver_suburb']='';
        $sender = Sender::updateOrCreate(['id'=> $request->id],$data);
        $data['sender_id'] = $sender->id;

        if(Auth::user()->role == 1){
          $data['approval'] = 1;
        }else{
          $data['approval'] = 0;
        }

        Receiver::updateOrCreate(['id'=> $request->receiver_id],$data);

        return redirect()->back()->with('success','Form Submitted Successfully , Waiting for Admin Approval');
    }

    public function update(Request $request)
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
           'acceptance'          => 'required',
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
        // $data['user_id'] = Auth::user()->id;
        // $data['membership_number'] = substr($request->sender_full_name, 0, 3).rand(11111,99999);
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

        Receiver::updateOrCreate(['id'=> $request->receiver_id],$data);

        if(Auth::user()->role == 1){
            if(Auth::user()->id == $sender->user_id){
             return redirect('admin/list-customer')->with('success','Member Updated Successfully!!');
            }else{
              return redirect('admin/member')->with('success','Member Updated Successfully!!');
            }
        }else{
             return redirect('user/aplication-form')->with('success','Form Updated Successfully!!');
        }
    }

    //Add new Benificary form 
    public function beneficiary()
    {   
        $beneficiary_count = Beneficiary::where('user_id',Auth::user()->id)->count();
        $sender = Sender::where('user_id',Auth::user()->id)->first();
        $states       = State::all();
        $provinces    = Province::all();
        return view('benificary.application_form',compact('states','beneficiary_count','provinces','sender')); 
    }
    
    public function beneficiaryStore(Request $request)
    {
        $this->validate($request, [
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
           'contact_number'      => 'required|numeric|min:10',
           'province'            => 'required',
       ]);
        
        $folderPath = public_path('upload/beneficiary/');        
        $image_parts = explode(";base64,", $request->signed);              
        $image_type_aux = explode("image/", $image_parts[0]);           
        $image_type = $image_type_aux[1];           
        $image_base64 = base64_decode($image_parts[1]);
        $image= uniqid() . '.'.$image_type;           
        $file = $folderPath . $image;
        file_put_contents($file, $image_base64);
        $data = $request->all();
        $data['signed']  = $image;
        // $data['user_id'] = Auth::user()->id;
        
        $data['receiver_suburb']='';
        Receiver::create($data);


        if(Auth::user()->role == 1){
          return redirect('admin/receivers-list/'.$request->sender_id)->with('success','Beneficiary Added Successfully!!');
          
        }else{
          return redirect('user/beneficiary')->with('success','Beneficiary Added Successfully!!');
        }
    }

    //  Beneficiary List
    public function beneficiaryList(Request $request)
    {
        $member  = Sender::select('senders.*','receivers.id as receiver_id','receivers.receiver_full_name','receivers.receiver_address','receivers.receiver_suburb','receivers.receiver_state','receivers.receiver_postcode','receivers.bank_name','receivers.accont_number','receivers.branch','receivers.sender_id','receivers.province','receivers.contact_number')->join('receivers','senders.id','=','receivers.sender_id')->where('user_id',Auth::user()->id)->first();   

        // $members_number=$this->split_name($member->sender_full_name);
        $beneficiary = Sender::select('senders.id as sender_id','senders.user_id','receivers.*')->join('receivers','senders.id','=','receivers.sender_id')->where('user_id',Auth::user()->id)->paginate('15');
        return view('benificary.beneficiarylist',compact('beneficiary'));
    }
//     function split_name($name) {
//         $nameWithoutPrefix=$name;
//         $words = explode(" ", $nameWithoutPrefix);
//         $firtsName = reset($words); 
//         $lastName  = end($words);
//         $sort = $firtsName[0].$firtsName[1];
//         if(isset($lastName))
//         {
//            $sort = $sort.$lastName[0];
//         }
//         if(isset($lastName[1]))
//         {
//             $sort = $sort.$lastName[1];
//         }
//         return $sort.rand(1000,9999); 
// }

    public function showBeneficiary(Request $request)
    {
        $beneficiary = Sender::select('senders.id as sender_id','receivers.*')->join('receivers','senders.id','=','receivers.sender_id')->where('receivers.id',$request->id)->first();
        return view('benificary.show_beneficiary',compact('beneficiary'));
    }
}
