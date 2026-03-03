<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_histories', function (Blueprint $table) {
            $table->id();

            // relasi ke student
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnDelete();

            // relasi ke user (yang melakukan aksi)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('action'); // created, updated, deleted, restored
            $table->json('before')->nullable();
            $table->json('after')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_histories');
    }
};
