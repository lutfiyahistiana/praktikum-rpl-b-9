<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('task_progress', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('percentage');
            $table->string('link_url')->nullable()->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('task_progress', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'link_url']);
        });
    }
};