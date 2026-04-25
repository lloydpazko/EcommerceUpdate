<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // sample database $table->string('created_by'); tinyint(4)
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('sku');
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->string('brand_id');
            $table->string('price');
            $table->string('old_price');
            $table->string('images');
            $table->text('short_description');
            $table->longtext('Description');
            $table->text('additional_information');
            $table->text('shipping_returns');
            $table->tinyInteger('status')->default('0')->comment('0:active, 1:inactive');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('is_delete')->default('0')->comment('0:not, 1: deleted');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
