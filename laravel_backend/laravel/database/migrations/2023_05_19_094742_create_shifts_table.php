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
        Schema::create('shifts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('id')->comment('The shift identifier');
            $table->foreignId('user_id')->comment('The identifier of the user belonging to the shift')->constrained('users', 'id')->onDelete('cascade');
            $table->dateTime('start_time')->comment('Start date of the shift');
            $table->dateTime('end_time')->comment('End date of the shift');
            $table->integer('hourly_wage')->unsigned()->comment('The hourly wage for the shift');
            $table->decimal('worked_hours', 10, 3)->unsigned()->comment('The number of hours worked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
};
