<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
            $table->text('sender');
            $table->text('text');
            $table->jsonb('nlu')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Add check constraint for sender field (PostgreSQL)
        DB::statement("ALTER TABLE messages ADD CONSTRAINT messages_sender_check CHECK (sender IN ('user', 'bot', 'owner'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE messages DROP CONSTRAINT IF EXISTS messages_sender_check');
        Schema::dropIfExists('messages');
    }
};
