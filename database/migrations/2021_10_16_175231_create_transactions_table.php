<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->float('rate');
            $table->float('fee');
            $table->float('total_payable');
            $table->float('receivable_amount');
            $table->float('aganet_ref');
            $table->string('purpose');
            $table->string('reference_id');
            $table->string('reference_table');
            $table->string('transaction_id');
            $table->enum('status',['waiting','processing','transfering','completed']);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
