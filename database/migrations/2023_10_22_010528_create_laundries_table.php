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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('claim_code');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->double('weight');
            $table->boolean('with_pickup')->default(false);
            $table->boolean('with_delivery')->default(false);
            $table->text('pickup_address')->nullable();
            $table->text('delivery_address')->nullable();
            $table->double('total');
            $table->text('description');
            $table->enum('status', [
                'Queue',
                'Pickup',
                'Process',
                'Washing',
                'Dried',
                'Ironed',
                'Done',
                'Delivery',
            ])->default('Queue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
