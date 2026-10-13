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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Batch 01 - City Bus
            $table->text('description')->nullable();
            $table->decimal('investment_amount', 15, 2); // Amount per user e.g. 50000
            $table->integer('max_members')->default(25);
            $table->integer('joined_members')->default(0);
            $table->enum('status', ['open', 'funding', 'active', 'closed'])->default('open');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
