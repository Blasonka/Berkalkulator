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

            $table->id('id')->comment('The wage identifier');
            $table->foreignId('user_id')->comment('The identifier of the user associated with the salary')->constrained('users', 'id')->onDelete('cascade');
            $table->string('name')->comment('The name of the wage');
            $table->integer('value')->comment('Value of the wage (hourly wage)');
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
