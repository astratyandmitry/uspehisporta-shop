<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table): void {
            $table->id();
            $table->string('hru', 80)->unique()->index();
            $table->string('name', 80)->unique();
            $table->string('logotype', 500)->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->boolean('active')->default(false);
            $table->integer('sort')->default(0)->index();
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
        Schema::dropIfExists('brands');
    }
}
