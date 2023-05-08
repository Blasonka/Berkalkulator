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
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('id')->comment('A felhasználó azonosítója.');
            $table->string('name', 50)->comment('A felhasználó neve.');
            $table->string('email', 100)->unique()->comment('A felhasználó email címe.');
            $table->timestamp('email_verified_at')->nullable()->comment('A felhasználó email címe meg lett e erősítve.');
            $table->string('password')->comment('A felhasználó jelszavának titkosított változata.');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
