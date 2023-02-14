<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProductPackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_packing');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
