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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('transactions_id');
             $table->foreign('transactions_id')->references('id')->on('transactions')->onDelete('cascade');
              $table->string('gateway')->default('cash');
               $table->string('reference');
                   $table->decimal('amount',10,2);
               $table->enum('status',['pending', 'succses', 'failed'])->default('pending');
                $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
