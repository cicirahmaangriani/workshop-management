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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('service_number')->unique()->nullable();
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        $table->foreignId('mechanic_id')->nullable()->constrained()->onDelete('set null');
        $table->date('service_date');
        $table->text('complaint')->nullable();
        $table->text('diagnosis')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
        $table->decimal('total_cost', 10, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
