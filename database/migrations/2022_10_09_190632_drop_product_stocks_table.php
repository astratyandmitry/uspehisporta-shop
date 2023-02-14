<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_stocks');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('product_stocks', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('packing_id')->index()->nullable();
            $table->unsignedInteger('taste_id')->index()->nullable();
            $table->integer('quantity');
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_sale')->nullable();
            $table->timestamps();
        });
    }
}
