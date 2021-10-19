<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
   protected $fillable=['sender_full_name','dob','telephone','sender_address','sender_suburb','sender_state','sender_postcode','occupation','political','presence','receiver_full_name','receiver_address','receiver_suburb','receiver_state','receiver_postcode','bank_name','accont_number','branch','signed','name','date','acceptance','document1','docfile1','document2','docfile2','user_id','contact_number','approval','province','doc_expiry1','doc_expiry2','membership_number'];

  public function user(){
    return $this->belongsTo(User::class);
  }
  public function stateReceiver(){
    return $this->belongsTo(State::class,'receiver_state');
  }
  public function stateSender(){
    return $this->belongsTo(State::class,'sender_state');
  }
  public function provinces(){
    return $this->belongsTo(Province::class,'province');
  }
}
