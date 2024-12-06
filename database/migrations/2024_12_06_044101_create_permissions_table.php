<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            $table->foreignId('sub_module_id')->constrained('sub_modules')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->tinyInteger('read')->default(0)->comment('0 no,1 yes');
            $table->tinyInteger('create')->default(0)->comment('0 no,1 yes');
            $table->tinyInteger('update')->default(0)->comment('0 no,1 yes');
            $table->tinyInteger('delete')->default(0)->comment('0 no,1 yes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
