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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name',100);
            $table->string('service_slug',100);
            $table->string('token',250);
            $table->string('service_desc',5000)->nullable();
            $table->string('service_img',100)->nullable();
            $table->string('service_price',100)->nullable();
            $table->string('service_tags',100)->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedBigInteger('service_cat_id');
            $table->foreign('service_cat_id')
            ->references('id')
            ->on('service_categories')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
