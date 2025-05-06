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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('slug',100);
            $table->string('secure_token',250);
            $table->string('post',5000);
            $table->string('img',100)->nullable();
            $table->string('tags',100)->nullable();
            $table->decimal('publishar_id',10, 2)->nullable();
            $table->decimal('publish_date',10, 2)->nullable();
            $table->string('extra_link',100)->nullable();
            $table->enum('status' , ['active', 'inactive'])->default('active');

            $table->unsignedBigInteger('post_cat_id');
            $table->foreign('post_cat_id')
            ->references('id')
            ->on('blogs_categories')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
