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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Name
            $table->string('name')->nullable(false);

            // Start and end date
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);

            // Address
            $table->text('address')->nullable();
            $table->string('province_code')->nullable();
            $table->string('city_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('village_code')->nullable();

            // Status
            $table->string('status')->default('pending');

            // Payment
            $table->string('payment_method')->default('midtrans');
            $table->string('payment_url')->nullable();
            $table->string('payment_status')->default('pending');

            // Amount
            $table->integer('amount')->default(0);

            // Relation to Item and User
            $table->foreignId('item_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
