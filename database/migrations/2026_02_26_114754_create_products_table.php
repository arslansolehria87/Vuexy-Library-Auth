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
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('sku')->unique();
        $table->decimal('price', 10, 2);
        $table->decimal('cost', 10, 2)->nullable();
        $table->integer('quantity')->default(0);
        $table->string('image')->nullable();
        $table->boolean('status')->default(1);
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
