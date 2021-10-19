<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_full_name');
            $table->text('receiver_address');
            $table->string('receiver_suburb');
            $table->string('receiver_state');
            $table->integer("receiver_postcode");
            $table->string('bank_name');
            $table->string("accont_number");
            $table->string('branch');
            $table->string("contact_number");
            $table->tinyInteger('province')->nullable();
            $table->integer('sender_id');
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
        Schema::dropIfExists('receivers');
    }
}
