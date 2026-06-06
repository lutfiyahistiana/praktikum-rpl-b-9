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
        Schema::create('chatbot_sessions', function (Blueprint $table) {
        $table->id('id_chatbot_session');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')
            ->references('id_user')
            ->on('users')
            ->onDelete('cascade');
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_sessions');
    }
};
