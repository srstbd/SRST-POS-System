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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');//string
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
        Schema::dropIfExists('categories');
    }
};
