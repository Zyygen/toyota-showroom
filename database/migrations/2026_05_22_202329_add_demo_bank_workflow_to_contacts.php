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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->enum('consultation_status', ['pending', 'completed'])->default('pending')->after('message');
            $table->string('deposit_token')->nullable()->after('consultation_status');
            $table->string('final_car_model')->nullable()->after('car_model');
            $table->decimal('deposit_amount', 15, 2)->nullable()->after('final_car_model');
            $table->enum('payment_status', ['unpaid', 'pending_verification', 'paid'])->default('unpaid')->after('deposit_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'email', 'consultation_status', 'deposit_token', 
                'final_car_model', 'deposit_amount', 'payment_status'
            ]);
        });
    }
};
