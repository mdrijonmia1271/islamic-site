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
        Schema::create('duas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dua_category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('title_bangla')->nullable();

            $table->longText('arabic_text');

            $table->longText('transliteration')->nullable();

            $table->longText('bangla_meaning')->nullable();

            $table->longText('english_meaning')->nullable();

            $table->string('reference')->nullable();

            $table->string('source')->nullable();

            $table->string('audio_url')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duas');
    }
};
