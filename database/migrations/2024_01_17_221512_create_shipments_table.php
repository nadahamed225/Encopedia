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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('shipper');
            $table->string('image')->nullable();
            $table->decimal('weight')->default(0.0);
            $table->text('description');
            $table->unsignedInteger('price')->default(0);
            $table->enum('status',['Pending','Progress','Done'])->default('Pending');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
