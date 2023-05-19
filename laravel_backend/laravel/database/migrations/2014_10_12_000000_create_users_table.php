<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('id')->comment('The user identifier');
            $table->string('name', 50)->comment('The name of the user');
            $table->string('email', 100)->unique()->comment('The user`s email address');
            $table->timestamp('email_verified_at')->nullable()->comment('The user`s email address has been confirmed');
            $table->string('password')->comment('An encrypted version of the user`s password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
