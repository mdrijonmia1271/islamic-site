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
        Schema::create('hadith_chapters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hadith_book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('chapter_number');

            $table->string('name');

            $table->string('name_bangla')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique([
                'hadith_book_id',
                'chapter_number'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadith_chapters');
    }
};
