<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Support\Str;
use App\Mail\verifyUser;
use DB;
use Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree_terms_and_conditions' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token'=>Str::random(40),
        ]);
    }
    protected function registered(Request $request, $user)
    { 
       $email = $user->email;

       // Mail::to($email)->send(new verifyUser($user));
        Mail::send('emails.verify_email', ['user'=>$user], function($message) use ($email){
            $message->from('info@ptmoney.com.au', "PTMoney");
            $message->subject('Verify Email - Activate your account');
            $message->to($email);                
        });
        // echo "<pre>";print_r($user);die;
        Auth::logout();
        $request->session()->flush();
        return redirect('register')->with('status','Registered Successfully !! Verification link sent to your mail, Please check.');
    }

    public function verifyUser($token,$id)
    {
        // echo '<pre>';print_r($id);die;
        $verifyUser = User::where('id', $token)->first();
        if(!empty($verifyUser)){
            $verifyUser->remember_token  = Null;
            $verifyUser->is_verified  = 1;
            $verifyUser->save();
            if (Auth::loginUsingId($verifyUser->id)) {
                return redirect('user');
            }else{
                return redirect()->back();
            } 
        }else{
            return redirect('register')->with('status','Invalid Token !');
        } 
    }
}
