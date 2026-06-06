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
        Schema::create('materials', function (Blueprint $table) {
        $table->id('id_material');
        $table->string('title');
        $table->text('description')->nullable();
        $table->unsignedBigInteger('uploaded_by');
        $table->foreign('uploaded_by')
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
        Schema::dropIfExists('materials');
    }
};
