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
        Schema::create('handoff_requests', function (Blueprint $table) {
            // Unique ID for each handoff request
            $table->id();

            // Foreign key to chatbots.id - assumes 'chatbots' table 'id' is VARCHAR(128)
            $table->foreignId('chatbot_id')->constrained('chatbots')->onDelete('cascade');

            // The Laravel user ID (owner of the chatbot) - assumes 'users' table 'uid' is VARCHAR(128)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('user_name')->nullable();
            $table->string('user_email');
            $table->string('user_phone', 50)->nullable();
            $table->json('query_history')->nullable();
            
            $table->text('summary')->nullable();
            $table->string('status', 50)->default('pending'); // 'pending', 'resolved', 'closed'
             // This creates 'created_at' and 'updated_at'
            $table->dateTime('resolved_at')->nullable(); // Separate field for resolution timestamp
            $table->text('agent_notes')->nullable();
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handoff_requests');
    }
};
