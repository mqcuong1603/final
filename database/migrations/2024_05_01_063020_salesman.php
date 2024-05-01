<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salesman', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isLocked')->default(false);
            $table->boolean('isActivated')->default(false);
            $table->string('profilePicture')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('activation_token')->nullable();
            $table->string('reset_token')->nullable();
            $table->string('reset_token_expiry')->nullable();
            $table->string('activation_token_expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesman');
    }
};
