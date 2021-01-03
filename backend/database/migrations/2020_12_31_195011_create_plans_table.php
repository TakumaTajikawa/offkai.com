<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->text('body')->nullable(false);
            $table->integer('pref_id')->nullable(false);
            $table->string('cities')->nullable();
            $table->string('genre')->nullable();
            $table->string('age')->nullable();
            $table->dateTime('meeting_date_time')->nullable(false);
            $table->string('membership_fee')->nullable();
            $table->string('img')->nullable();
            $table->string('venue')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('plans');
    }
}
