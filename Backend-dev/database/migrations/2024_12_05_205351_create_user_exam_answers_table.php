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
        Schema::create('user_exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mock_exam_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->index()->constrained()->onDelete('cascade');
            $table->string('selected_option');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_exam_answers');
    }
};
