<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable(); 
            $table->integer('current_storypoints')->nullable(); 

            $table->unsignedBigInteger('charactertype_id');
            $table->foreign('charactertype_id')->references('id')->on('charactertypes');
            
            $table->unsignedBigInteger('characterlevel_id');
            $table->foreign('characterlevel_id')->references('id')->on('characterlevels');

            // $table->unsignedBigInteger('characterLevel_id');
            // $table->foreign('characterLevel_id')->references('id')->on('characterLevels');
            
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');

            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
