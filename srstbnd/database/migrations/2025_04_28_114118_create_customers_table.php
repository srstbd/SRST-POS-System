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
