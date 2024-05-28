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
        Schema::create('promotional_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Clave foránea para asociar con el usuario
            $table->unsignedBigInteger('offer_id'); // Clave foránea para asociar con la oferta
            $table->string('code')->unique(); // Código promocional único
            $table->enum('status', ['generated', 'exchanged'])->default('generated'); // Estado del código promocional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotional_codes');
    }
};
