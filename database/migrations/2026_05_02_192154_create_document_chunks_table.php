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
        if (\Illuminate\Support\Facades\DB::getDriverName() === 'pgsql') {
            Schema::ensureVectorExtensionExists();
        }

        Schema::create('document_chunks', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->string('heading')->nullable();
            $table->text('chunk_text');
            $table->json('metadata')->nullable();
            if (\Illuminate\Support\Facades\DB::getDriverName() === 'pgsql') {
                $table->vector('embedding', dimensions: 768)->index(); // Ollama
            } else {
                $table->text('embedding')->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_chunks');
    }
};
