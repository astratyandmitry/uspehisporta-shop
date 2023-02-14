<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProductRemainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_remains');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('product_remains', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('packing_id')->index()->nullable();
            $table->unsignedInteger('taste_id')->index()->nullable();
            $table->integer('quantity');
            $table->timestamps();
        });
    }
}
