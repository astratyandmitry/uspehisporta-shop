<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('baskets', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->uuid('session_key')->index()->nullable();
            $table->unsignedInteger('taste_id')->index();
            $table->unsignedInteger('packing_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('count')->default(0);
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
        Schema::dropIfExists('baskets');
    }
}
