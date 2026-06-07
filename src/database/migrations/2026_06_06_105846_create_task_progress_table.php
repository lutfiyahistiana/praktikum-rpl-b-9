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
        Schema::create('task_progress', function (Blueprint $table) {
        $table->id('id_task_progress');
        $table->unsignedBigInteger('task_id');
        $table->unsignedBigInteger('user_id');
        $table->text('notes')->nullable();
        $table->float('percentage')->default(0);
        $table->foreign('task_id')
            ->references('id_task')
            ->on('task')
            ->onDelete('cascade');
        $table->foreign('user_id')
            ->references('id_user')
            ->on('users')
            ->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_progress');
    }
};
