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
        Schema::create('shifts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('id')->comment('A műszak azonosítója');
            $table->foreignId('user_id')->comment('A műszakhoz tartozó felhasználó azonosítója')->constrained('users', 'id')->onDelete('cascade');
            $table->dateTime('start_time')->comment('A műszak kezdő dátuma');
            $table->dateTime('end_time')->comment('A műszak vég dátuma');
            $table->integer('hourly_wage')->unsigned()->comment('A műszakhoz tartozó órabér');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
