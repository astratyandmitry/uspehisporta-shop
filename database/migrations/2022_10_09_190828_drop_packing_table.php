<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('packing');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('packing', function (Blueprint $table): void {
            $table->id();
            $table->string('hru', 40)->unique()->index();
            $table->string('name', 80)->unique();
            $table->timestamps();
        });
    }
}
