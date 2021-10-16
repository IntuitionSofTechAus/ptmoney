<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = ['amount','rate','fee','total_payable','receivable_amount','aganet_ref','purpose','reference_id','reference_table','status','is_deleted','transaction_id'];
}
