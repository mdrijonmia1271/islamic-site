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
        Schema::create('islamic_events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('title_bangla')->nullable();
            $table->text('description')->nullable();

            $table->unsignedTinyInteger('hijri_month');
            $table->unsignedTinyInteger('hijri_day');
            $table->unsignedSmallInteger('hijri_year')->nullable();

            $table->date('gregorian_date')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('islamic_events');
    }
};
