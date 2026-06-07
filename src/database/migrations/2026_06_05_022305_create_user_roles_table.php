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
        Schema::create('user_roles', function (Blueprint $table) {

        $table->id('id_user_role');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_role');
        $table->foreign('id_user')
            ->references('id_user')
            ->on('users')
            ->onDelete('cascade');
        $table->foreign('id_role')
            ->references('id_role')
            ->on('roles')
            ->onDelete('cascade');
        $table->unique(['id_user', 'id_role']);
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
