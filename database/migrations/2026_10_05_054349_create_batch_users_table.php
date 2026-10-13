<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // এখানে batch_users এর বদলে batch_user হবে
        Schema::create('batch_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('invested_amount', 15, 2);
            $table->enum('status', ['active', 'withdrawn'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // এখানেও batch_user হবে
        Schema::dropIfExists('batch_user');
    }
};