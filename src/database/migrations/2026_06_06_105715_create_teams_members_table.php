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
        Schema::create('teams_members', function (Blueprint $table) {
        $table->id('id_team_member');
        $table->unsignedBigInteger('team_id');
        $table->unsignedBigInteger('anggota_id');
        $table->foreign('team_id')
            ->references('id_team')
            ->on('teams')
            ->onDelete('cascade');
        $table->foreign('anggota_id')
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
        Schema::dropIfExists('teams_members');
    }
};
