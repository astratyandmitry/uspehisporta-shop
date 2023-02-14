<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table): void {
            $table->id();
            $table->string('position_key', 40)->index();
            $table->string('title', 200);
            $table->string('image', 500);
            $table->string('image_mobile', 500);
            $table->string('url', 500);
            $table->integer('sort')->default(0)->index();
            $table->boolean('active')->default(false)->index();
            $table->timestamps();

            $table->foreign('position_key')->references('key')->on('banner_positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
}
