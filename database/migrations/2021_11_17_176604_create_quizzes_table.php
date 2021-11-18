<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->dateTime('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('pass_percentage')->nullable();
		

            $table->foreign('version_id')->references('id')->on('versions');
            $table->foreign('class_id')->references('id')->on('clas');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
