<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('brand_id')->constrained('brands')->nullable();
            $table->string('hru', 80)->unique()->index();
            $table->string('name', 120)->unique();
            $table->string('image', 500);
            $table->double('rating', 10, 2)->default(0.0);
            $table->text('about')->nullable();
            $table->string('badges', 1000)->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->unsignedInteger('count_views')->default(0);
            $table->boolean('active')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
