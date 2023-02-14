<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('order_id')->index();
            $table->unsignedInteger('taste_id')->index();
            $table->unsignedInteger('packing_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('price');
            $table->unsignedInteger('count');
            $table->unsignedInteger('total');
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
        Schema::dropIfExists('order_items');
    }
}
