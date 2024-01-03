<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('exam_id')->constrained();
            $table->foreignId('question_id')->constrained();
            $table->json('selected_answers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_responses');
    }
};
