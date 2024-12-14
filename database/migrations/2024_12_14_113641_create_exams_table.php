<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_category_id')->constrained('exam_categories');
            $table->foreignId('created_by')->constrained('admins')->cascadeOnDelete();
            $table->string('exam_uid');
            $table->string('title');
            $table->longText('description');
            $table->dateTime('exam_date');
            $table->decimal('duration')->comment('0 means infinite time else in hour');
            $table->integer('total_question');
            $table->double('passing_percentage');
            $table->double('total_score')->default(0);
            $table->enum('status',['active','inactive','completed'])->default('active');
            $table->double('time_limit_per_question')->comment('0 means infinite time else in sec')->default(0);
            $table->enum('result_published',['yes','no'])->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
