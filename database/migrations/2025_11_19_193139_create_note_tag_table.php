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
        Schema::create('note_tag', function (Blueprint $table) {
            $table->foreignUuid('note_id')->references('id')->on('notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['note_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_tag');
    }
};
