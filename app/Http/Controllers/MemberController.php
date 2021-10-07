<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Member;

class MemberController extends Controller
{
    
    //Add new member form after login
    public function index()
    {
        return view('member.application_form'); 
    }

    //Store member detail

    public function store(Request $request)
    {
         $this->validate($request, [
           'sender_full_name'    => 'required',
           'dob'                 => 'required',
           'telephone'           => 'required',
           'sender_address'      => 'required',
           'sender_suburb'       => 'required',
           'sender_state'        => 'required',
           'sender_postcode'     => 'required',
           'occupation'          => 'required',
           'political'           => 'required',
           'presence'            => 'required',
           'receiver_full_name'  => 'required',
           'receiver_address'    => 'required',
           'receiver_suburb'     => 'required',
           'receiver_state'      => 'required',
           'receiver_postcode'   => 'required',
           'bank_name'           => 'required',
           'accont_number'       => 'required',
           'branch'              => 'required',
           'signed'              => 'required',
           'name'                => 'required',
           'date'                => 'required',
           'acceptance'          => 'required',
           'document1'           => 'required',
           'docfile1'            => 'required',
           'document2'           => 'required',
           'docfile2'            => 'required'
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
        Member::create($data);
        return redirect()->back()->with('success','Form created successful wait for admin review');
    }
}
