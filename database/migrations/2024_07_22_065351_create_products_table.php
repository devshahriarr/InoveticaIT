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
            $table->string('product_name',100);
            $table->string('product_slug',100);
            $table->string('secure_token',250);
            $table->string('product_desc',5000)->nullable();
            $table->string('product_img',100)->nullable();
            $table->string('product_tags',100)->nullable();
            $table->decimal('product_price',10, 2);
            $table->string('product_link',100)->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedBigInteger('product_cat_id');
            $table->foreign('product_cat_id')
            ->references('id')
            ->on('product_categories')
            ->onDelete('cascade');
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
