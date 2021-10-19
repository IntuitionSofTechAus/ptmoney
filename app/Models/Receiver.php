<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $fillable=['receiver_full_name','receiver_address','receiver_suburb','receiver_state','receiver_postcode','bank_name','accont_number','branch','sender_id','province','contact_number','signed','name','date'];

    public function stateReceiver(){
	   return $this->belongsTo(State::class,'receiver_state');
	}
	  
	public function provinces(){
	   return $this->belongsTo(Province::class,'province');
	}
}
