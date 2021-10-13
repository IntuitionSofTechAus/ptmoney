<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\State;
use App\Models\Member;
use App\Models\Beneficiary;
use App\Models\Province;

class MemberController extends Controller
{
    
    //Add new member form after login
    public function index()
    {   
        $member_count = Member::where('user_id',Auth::user()->id)->count();
        $member       = Member::where('user_id',Auth::user()->id)->first();
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
        if($request->hasFile('docfile1')){
           $data['docfile1'] = $request->file('docfile1')->store('upload/docfile1');
        }
         if($request->hasFile('docfile2')){
            $data['docfile2'] = $request->file('docfile2')->store('upload/docfile2');
        }
        $data['receiver_suburb']='';
        Member::updateOrCreate(['id'=> $request->id],$data);
        return redirect()->back()->with('success','Form Submitted Successfully , Waiting for Admin Approval');
        
    }
    //Add new Benificary form 
    public function beneficiary()
    {   
        $beneficiary_count = Beneficiary::where('user_id',Auth::user()->id)->count();
        $states       = State::all();
        $provinces    = Province::all();
        return view('benificary.application_form',compact('states','beneficiary_count','provinces')); 
    }
      public function beneficiaryStore(Request $request)
    {
         $this->validate($request, [
           'membership_number'   =>'required|numeric|digits_between:1,10',
           'sender_full_name'    => 'required|min:3',
           'dob'                 => 'required',
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
        $data['user_id'] = Auth::user()->id;
        $data['receiver_suburb']='';
        Beneficiary::create($data);
        return redirect()->route('beneficiary.list')->with('success','Form Submitted Successfully ');
    }

    //  Beneficiary List
    public function beneficiaryList(Request $request)
    {
        $beneficiary = Beneficiary::orderBy('created_at','desc')->where('user_id',Auth::user()->id)->paginate('15');
        return view('benificary.beneficiarylist',compact('beneficiary'));
    }

    public function showBeneficiary(Request $request)
    {
        $beneficiary = Beneficiary::find($request->id);
        return view('benificary.show_beneficiary',compact('beneficiary'));
    }

}
