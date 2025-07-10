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
        Schema::create('_investment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');                 // Investor User ID (Foreign Key)
            $table->decimal('amount', 10, 2);                      // Investment Amount
            $table->decimal('parent_bonus', 10, 2)->default(0.00);
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Parent's 10% Bonu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_investment');
    }
};
