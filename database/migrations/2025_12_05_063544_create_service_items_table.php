<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel services
            $table->foreignId('service_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Relasi ke tabel spare_parts
            $table->foreignId('spare_part_id')
                  ->constrained('spare_parts')
                  ->onDelete('cascade');

            $table->integer('quantity');
            $table->decimal('price', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};
