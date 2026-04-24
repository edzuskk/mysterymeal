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
        Schema::create('high_scores', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->integer('score');
            $table->integer('items_caught')->default(0);
            $table->integer('survival_time')->default(0); // in seconds
            $table->integer('level')->default(1);
            $table->timestamp('played_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['session_id', 'score']);
            $table->index('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('high_scores');
    }
};
