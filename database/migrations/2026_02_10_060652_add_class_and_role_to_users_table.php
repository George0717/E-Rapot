<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_class_id')
                  ->nullable()
                  ->after('email')
                  ->constrained('sm_classes')
                  ->cascadeOnDelete();

            $table->enum('role', ['ketua_kelas', 'anggota'])
                  ->default('anggota')
                  ->after('school_class_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['school_class_id']);
            $table->dropColumn(['school_class_id', 'role']);
        });
    }
};
