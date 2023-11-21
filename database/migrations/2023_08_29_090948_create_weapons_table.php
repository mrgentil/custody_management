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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('serie_number');
            $table->date('acquisition_date');
            $table->enum('state', ['En possession', 'Non possession'])->default('Non possession');
            $table->unsignedBigInteger('guard_id')->nullable(); // Clé étrangère nullable
            $table->timestamps();

            $table->foreign('guard_id')->references('id')->on('guards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
