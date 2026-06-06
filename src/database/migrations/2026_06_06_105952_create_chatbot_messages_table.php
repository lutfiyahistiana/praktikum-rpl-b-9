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
        Schema::create('chatbot_messages', function (Blueprint $table) {
        $table->id('id_chatbot_message');
        $table->unsignedBigInteger('session_id');
        $table->enum('role', ['user', 'assistant']);
        $table->text('message');
        $table->foreign('session_id')
            ->references('id_chatbot_session')
            ->on('chatbot_sessions')
            ->onDelete('cascade');
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_messages');
    }
};
