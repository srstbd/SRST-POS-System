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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // BIGINT, Primary Key
            $table->string('invoice_no')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->comment('for walk-in customers');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('cashier id'); // Cashier ID
            $table->decimal('total_amount', 10, 2);//decimal
            $table->decimal('paid_amount', 10, 2);//decimal
            $table->enum('payment_method', ['cash', 'card', 'mobile', 'mixed']);
            $table->enum('status', ['completed', 'pending', 'cancelled']);
            $table->timestamp('sale_date');
            $table->boolean('synced')->default(false)->comment('important for offline');
            $table->softDeletes('deleted_at'); // deleted_at
            $table->string('created_by_ip', 45)->nullable();
            $table->string('updated_by_ip', 45)->nullable();
            $table->string('deleted_by_ip', 45)->nullable();
            $table->boolean('status')->default(1)->comment('0: inactive, 1: active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
