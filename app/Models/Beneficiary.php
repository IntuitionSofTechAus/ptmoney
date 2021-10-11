<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
        use HasFactory;

   protected $fillable=['membership_number','sender_full_name','dob','receiver_full_name','receiver_address','receiver_suburb','receiver_state','receiver_postcode','bank_name','accont_number','branch','signed','name','date','user_id','contact_number'];
    public function user(){
    return $this->belongsTo(User::class);
  }
  public function stateReceiver(){
    return $this->belongsTo(State::class,'receiver_state');
  }

}
