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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('function');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('category_id')->references('id')->on('categorie_users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('avatar')->nullable();
            $table->string('adresse');
            $table->string('phone');
            $table->enum('gender', ['M', 'F']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};
