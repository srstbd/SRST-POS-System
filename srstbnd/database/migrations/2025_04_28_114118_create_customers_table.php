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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();//BIGINT, Primary Key
            $table->string('name');//string
            $table->string('phone');//string
            $table->string('email')->nullable();//string
            $table->text('address')->nullable();//text
            $table->integer('loyalty_points')->default(0);//integer
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
        Schema::dropIfExists('customers');
    }
};
