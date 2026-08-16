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
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surah_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedInteger('ayah_number');
            $table->text('arabic_text');
            $table->text('bangla_text')->nullable();
            $table->timestamps();

            $table->unique([
                'surah_id',
                'ayah_number'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayahs');
    }
};
