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
        Schema::table('services', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambahkan
            if (!Schema::hasColumn('services', 'estimated_days')) {
                $table->integer('estimated_days')->nullable()->after('labor_cost');
            }
            if (!Schema::hasColumn('services', 'notes')) {
                $table->text('notes')->nullable()->after('completion_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'estimated_days')) {
                $table->dropColumn('estimated_days');
            }
            if (Schema::hasColumn('services', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};