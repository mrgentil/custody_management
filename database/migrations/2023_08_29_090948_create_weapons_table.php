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
            $table->string('type');
            $table->string('serie_number');
            $table->date('acquisition_date');
            $table->enum('state', ['En possession', 'Non possession']);
            $table->unsignedBigInteger('guard_id')->nullable();
            $table->foreign('guard_id')->references('id')->on('guards');
            $table->timestamps();
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
