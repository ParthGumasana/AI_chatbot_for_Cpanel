<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // Corrected: No '->' here
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Renamed table to 'backend_sessions' to avoid conflict with Laravel's built-in 'sessions' table
        Schema::create('backend_sessions', function (Blueprint $table) {
            $table->string('session_id', 255)->primary(); // VARCHAR(255) PRIMARY KEY for the Flask backend's session ID

            // These must be UNSIGNED BIGINT to correctly reference Laravel's default $table->id() columns
            // Ensure 'users' and 'chatbots' tables actually use `id` as `bigIncrements` (Laravel's default for $table->id())
            $table->unsignedBigInteger('chatbot_id');      // References chatbots.id (BIGINT UNSIGNED)
            $table->unsignedBigInteger('owner_user_id');   // References users.id (BIGINT UNSIGNED)

            $table->string('client_sid', 255);            // VARCHAR(255) NOT NULL
            $table->timestamp('created_at')->useCurrent(); // DATETIME DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('last_activity')->useCurrent()->useCurrentOnUpdate(); // DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            $table->integer('message_count')->default(0); // INT DEFAULT 0
            $table->boolean('is_active')->default(true);  // BOOLEAN DEFAULT TRUE
            $table->boolean('is_in_handoff')->default(false); // BOOLEAN DEFAULT FALSE

            // Foreign key constraints
            // These now correctly reference the BIGINT UNSIGNED 'id' columns
            $table->foreign('chatbot_id')->references('id')->on('chatbots')->onDelete('cascade');
            $table->foreign('owner_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_sessions');
    }
};