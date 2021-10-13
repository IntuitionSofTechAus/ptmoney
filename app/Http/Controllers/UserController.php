<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.dashboard');
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function update(Request $request)
    {
        $data=$request->all();
        if($request->hasFile('profile')){
           $data['profile'] = $request->file('profile')->store('paper/img/user');
        } 
        auth()->user()->update($data);
        return back()->withStatus(__('Profile successfully updated.'));
    }
}
