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
        Schema::create('material_files', function (Blueprint $table) {
        $table->id('id_material_file');
        $table->unsignedBigInteger('material_id');
        $table->string('file_type');
        $table->string('file_path');
        $table->string('file_name');
        $table->foreign('material_id')
            ->references('id_material')
            ->on('materials')
            ->onDelete('cascade');
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_files');
    }
};
