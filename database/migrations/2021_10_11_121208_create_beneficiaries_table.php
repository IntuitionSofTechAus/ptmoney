<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('membership_number');
            $table->string('sender_full_name');
            $table->date('dob');
            $table->string('receiver_full_name');
            $table->text('receiver_address');
            $table->string('receiver_suburb');
            $table->string('receiver_state');
            $table->integer("receiver_postcode");
            $table->string('bank_name');
            $table->string("accont_number");
            $table->string('branch');
            $table->string("contact_number");
            $table->string('signed');
            $table->string('name');
            $table->date('date');
            $table->tinyInteger('approval')->default(0)->comment('0 for panding','1 for approved','2 for approved');
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
        Schema::dropIfExists('beneficiaries');
    }
}
