<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
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
            $table->string('membership_number')->nullable();
            $table->date('doc_expiry1')->nullable();
            $table->date('doc_expiry2')->nullable();
            $table->string('signed');
            $table->string('name');
            $table->date('date');
            $table->integer('acceptance');
            $table->string('document1');
            $table->string('docfile1');
            $table->string('document2');
            $table->string('docfile2');
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
        Schema::dropIfExists('senders');
    }
}
