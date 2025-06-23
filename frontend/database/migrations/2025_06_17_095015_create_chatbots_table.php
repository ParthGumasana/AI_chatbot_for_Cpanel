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
         Schema::create('chatbots', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Assuming you have a users table

            $table->string('name');
            $table->text('description')->nullable();
            $table->json('data_sources')->nullable(); 
            $table->string('llm_type', 50); // 'LM_STUDIO' or 'OPENAI'
            $table->string('openai_api_key', 255)->nullable(); // Stored as plain text for now, consider encryption
            $table->boolean('is_ready')->default(false); // True if vector store is built
            $table->timestamps(); 
            $table->string('embed_url', 512)->nullable();
            $table->string('status_message', 255)->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbots');
    }
};
