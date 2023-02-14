<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('managers', function (Blueprint $table): void {
            $table->id();
            $table->string('role_key', 40)->index();
            $table->string('email', 80)->unique()->index();
            $table->string('password', 500);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_key')->references('key')->on('manager_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
}
