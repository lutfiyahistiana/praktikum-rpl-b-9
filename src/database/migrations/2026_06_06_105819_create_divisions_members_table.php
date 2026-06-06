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
        Schema::create('divisions_members', function (Blueprint $table) {
        $table->id('id_division_member');
        $table->unsignedBigInteger('division_id');
        $table->unsignedBigInteger('anggota_id');
        $table->foreign('division_id')
            ->references('id_division')
            ->on('divisions')
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
        Schema::dropIfExists('divisions_members');
    }
};
