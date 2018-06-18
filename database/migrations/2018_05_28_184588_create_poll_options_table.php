<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('poll_options', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("option_name");
            $table->integer("vote_count")->default(0);
            $table->unsignedInteger('poll_id');
            $table->foreign('poll_id')->references('id')->on('polls');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_options');
    }
}
