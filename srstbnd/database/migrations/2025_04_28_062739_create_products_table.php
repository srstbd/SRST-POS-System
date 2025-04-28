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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');// (string)
            $table->string('sku')->unique()->comment('Barcode');// (string, unique)  // Barcode
            $table->foreignId('category_id')->constrained()->onDelete('cascade');// (foreign key)
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');// (foreign key, nullable)
            $table->string('unit')->comment('e.g. kg, pcs, liter');// (string) // e.g., kg, pcs, liter
            $table->decimal('price', 8,2);// (decimal)
            $table->decimal('cost', 8,2);// (decimal)
            $table->integer('stock_quantity');// (integer)
            $table->longText('description')->nullable();// (text, nullable)
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
        Schema::dropIfExists('products');
    }
};
