<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */

    //  $table->string('product_id'); int
    //  $table->string('image_name');
    //  $table->string('image_extension');
    //  $table->string('order_by'); as defined 100
    public function up(): void
    {
        Schema::create('product_image', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('image_name');
            $table->string('image_extension');
            $table->string('order_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_image');
    }
};
