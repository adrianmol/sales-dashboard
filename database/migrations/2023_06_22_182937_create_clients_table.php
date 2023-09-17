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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('foreign_id')->unique();
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('company', 64)->nullable();
            $table->string('phone_number', 24)->nullable();
            $table->string('email', 64);
            $table->string('vat_number', 16)->nullable();
            $table->string('status',32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
