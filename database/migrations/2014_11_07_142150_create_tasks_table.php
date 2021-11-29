<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('project_id')->nullable(); 
            $table->string('title'); 
            $table->string('description'); 

            $table->unsignedBigInteger('assigne_id')->nullable(); 
            $table->foreign('assigne_id')->references('id')->on('users')->nullable();

            $table->integer('storypoints');
            $table->string('status');
            $table->integer('sort_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
