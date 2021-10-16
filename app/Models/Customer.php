<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = ['sender_full_name','dob','telephone','sender_address','sender_suburb','sender_state','sender_postcode','occupation','political','presence','receiver_full_name','receiver_address','receiver_suburb','receiver_state','receiver_postcode','bank_name','accont_number','branch','signed','name','date','document1','docfile1','document2','docfile2','contact_number','approval','province','doc_expiry1','doc_expiry2','membership_number','status'];
}
