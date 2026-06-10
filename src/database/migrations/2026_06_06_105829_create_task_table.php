<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id('id_task');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('assigned_by');
            $table->dateTime('deadline')->nullable();
            $table->enum('status', [
                'pending',
                'in_progress',
                'done'
            ])->default('pending');
            $table->foreign('assigned_to')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('assigned_by')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};