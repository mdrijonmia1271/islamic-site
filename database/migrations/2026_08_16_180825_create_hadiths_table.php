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
        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hadith_book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('hadith_chapter_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->unsignedInteger('hadith_number');

            $table->longText('arabic_text');

            $table->longText('bangla_text')->nullable();

            $table->longText('english_text')->nullable();

            $table->string('narrator')->nullable();

            $table->string('grade')->nullable();

            $table->string('reference')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'hadith_book_id',
                'hadith_number'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadiths');
    }
};
