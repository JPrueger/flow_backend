<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('character_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('tag_color')->nullable();
            $table->boolean('level_one_played')->nullable()->default(0);
            $table->boolean('level_two_played')->nullable()->default(0);
            $table->boolean('level_three_played')->nullable()->default(0);
            
            $table->unsignedBigInteger('character_id')->nullable();
            $table->foreign('character_id')->references('id')->on('characters');

            $table->integer('storypoints')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
