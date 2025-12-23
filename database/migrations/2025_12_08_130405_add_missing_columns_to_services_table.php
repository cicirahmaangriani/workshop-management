<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('action_taken')->nullable()->after('diagnosis');
            $table->decimal('labor_cost', 10, 2)->default(0)->after('status');
            $table->dateTime('completion_date')->nullable()->after('labor_cost');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['action_taken', 'labor_cost', 'completion_date']);
        });
    }
};
