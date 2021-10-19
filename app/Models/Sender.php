<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    protected $fillable=['sender_full_name','dob','telephone','sender_address','sender_suburb','sender_state','sender_postcode','occupation','political','presence','signed','name','date','acceptance','document1','docfile1','document2','docfile2','user_id','approval','doc_expiry1','doc_expiry2','membership_number'];

   	  public function user(){
	    return $this->belongsTo(User::class);
	  }
	  public function stateSender(){
	    return $this->belongsTo(State::class,'sender_state');
	  }
	  
}
