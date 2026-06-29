<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            // Hapus kolom room dan notes
            $table->dropColumn(['room', 'notes']);
            // Tambah kolom meeting_link yang diisi oleh guru
            $table->string('meeting_link')->nullable()->after('end_time');
        });
    }

    public function down(): void
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropColumn('meeting_link');
            $table->string('room')->nullable();
            $table->text('notes')->nullable();
        });
    }
};
