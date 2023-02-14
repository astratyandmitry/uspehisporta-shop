<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cities');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('cities', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 80)->unique()->index();
            $table->string('phone', 14)->unique();
            $table->string('address', 120);
            $table->timestamps();
        });
    }
}
