<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name', 255);
            $table->boolean('status')->default(0);
            $table->integer('position')->unsigned();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
