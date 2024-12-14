<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_uid');
            $table->longText('question_text');
            $table->enum('question_type', ['mcq', 'true_false']);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->nullable();
            $table->decimal('points');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
