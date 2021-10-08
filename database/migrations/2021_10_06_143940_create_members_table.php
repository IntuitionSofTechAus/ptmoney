<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('sender_full_name');
            $table->date('dob');
            $table->string("telephone");
            $table->text('sender_address');
            $table->string('sender_suburb');
            $table->string('sender_state');
            $table->integer("sender_postcode");
            $table->string('occupation');
            $table->string('political');
            $table->string('presence');
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
            $table->integer('acceptance');
            $table->string('document1');
            $table->string('docfile1');
            $table->string('document2');
            $table->string('docfile2');
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
        Schema::dropIfExists('members');
    }
}
