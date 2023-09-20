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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('foreign_reference')->nullable();
            $table->foreignId('user_id');
            $table->string('first_name',64)->nullable();
            $table->string('last_name',64)->nullable();
            $table->string('company_name',64)->nullable();
            $table->string('invoice_number', 32);
            $table->date('due_date')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->dateTime('cancelled_date')->nullable();
            $table->decimal('sub_total',8,2);
            $table->decimal('credit',8,2)->default(0)->nullable();
            $table->decimal('tax',8,2);
            $table->decimal('tax2',8,2)->default(0)->nullable();
            $table->decimal('tax_rate',8,2)->default(0)->nullable();
            $table->decimal('tax_rate2',8,2)->default(0)->nullable();
            $table->decimal('total',8,2);
            $table->string('status',32);
            $table->string('payment_method',32);
            $table->integer('payment_id',)->nullable();
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
