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
        Schema::dropIfExists('prayer_times');

        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();

            $table->string('city', 100);
            $table->string('country', 100)->nullable();

            $table->date('date');

            $table->time('fajr')->nullable();
            $table->time('sunrise')->nullable();
            $table->time('dhuhr')->nullable();
            $table->time('asr')->nullable();
            $table->time('maghrib')->nullable();
            $table->time('isha')->nullable();

            $table->timestamps();

            $table->unique([
                'city',
                'country',
                'date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_times');
    }
};
