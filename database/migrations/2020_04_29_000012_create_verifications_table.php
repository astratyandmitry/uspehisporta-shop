<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table): void {
            $table->id();
            $table->string('type_key', 40)->index();
            $table->foreignId('user_id')->constrained('users');
            $table->string('code', 12)->index();
            $table->timestamp('expired_at');
            $table->timestamps();

            $table->foreign('type_key')->references('key')->on('verification_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
}
