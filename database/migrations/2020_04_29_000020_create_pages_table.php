<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->string('hru', 80)->unique()->index();
            $table->string('name', 120)->unique();
            $table->string('title', 120)->unique();
            $table->text('content')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->boolean('system')->default(false)->index();
            $table->boolean('active')->default(false)->index();
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
        Schema::dropIfExists('pages');
    }
}
