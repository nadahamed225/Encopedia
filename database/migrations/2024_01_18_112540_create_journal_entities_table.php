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
        Schema::create('journal_entities', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->enum('type',['Debit Cash','Credit Revenue','Credit Payable']);
            $table->unsignedBigInteger('shipment');
            $table->foreign('shipment')->references('id')->on('shipments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entities');
    }
};
