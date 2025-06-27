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
        // This migration is robust with checks to ensure it only adds the column if it doesn't exist
        if (!Schema::hasColumn('handoff_requests', 'session_id')) {
            Schema::table('handoff_requests', function (Blueprint $table) {
                // VARCHAR(255) NULL, placed after 'agent_notes' for logical grouping.
                $table->string('session_id', 255)->nullable()->after('agent_notes');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the column exists before dropping to prevent errors
        if (Schema::hasColumn('handoff_requests', 'session_id')) {
            Schema::table('handoff_requests', function (Blueprint $table) {
                $table->dropColumn('session_id');
            });
        }
    }
};