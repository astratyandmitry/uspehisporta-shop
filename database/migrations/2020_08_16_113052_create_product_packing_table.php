<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_packing', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('packing_id')->index();
            $table->unsignedInteger('price')->index();
            $table->unsignedInteger('price_sale')->index()->nullable();
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
        Schema::dropIfExists('product_packing');
    }
}
