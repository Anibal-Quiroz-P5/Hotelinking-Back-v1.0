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
        Schema::table('promotional_codes', function (Blueprint $table) {
            if (!Schema::hasColumn('promotional_codes', 'user_id')) {
                $table->foreignId('user_id')->constrained('users');
            }
    
            if (!Schema::hasColumn('promotional_codes', 'offer_id')) {
                $table->foreignId('offer_id')->constrained('offers');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotional_codes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['offer_id']);
        });
    }
};
