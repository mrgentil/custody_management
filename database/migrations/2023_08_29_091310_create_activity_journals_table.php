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
        Schema::create('activity_journals', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_heure');
            $table->unsignedBigInteger('guard_id');
            $table->foreign('guard_id')->references('id')->on('guards');
            $table->string('action');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_journals');
    }
};
