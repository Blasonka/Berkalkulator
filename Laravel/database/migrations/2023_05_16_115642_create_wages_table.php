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
        Schema::create('wages', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('id')->comment('A bér azonosítója');
            $table->foreignId('user_id')->comment('A bérhez tartozó felhasználó azonosítója')->constrained('users', 'id')->onDelete('cascade');
            $table->string('name')->comment('A bér megnevezése');
            $table->integer('value')->comment('A bér értéke (órabér)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wages');
    }
};
