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
        Schema::table('users', function (Blueprint $table) {
        $table->string('prodi', 100)->nullable()->after('name');
        $table->string('fakultas', 100)->nullable()->after('prodi');
        $table->string('no_hp', 20)->nullable()->after('fakultas');
        $table->string('username_github', 100)->nullable()->after('no_hp');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
