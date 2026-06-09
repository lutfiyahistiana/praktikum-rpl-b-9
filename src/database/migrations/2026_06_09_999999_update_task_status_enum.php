<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing data to new status values
        DB::table('task')->where('status', 'belum_dikerjakan')->update(['status' => 'pending']);
        DB::table('task')->where('status', 'selesai')->update(['status' => 'done']);
        DB::table('task')->where('status', 'terlambat')->update(['status' => 'pending']);

        // Change the enum column
        DB::statement("ALTER TABLE `task` MODIFY COLUMN `status` ENUM('pending', 'in_progress', 'done') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::table('task')->where('status', 'pending')->update(['status' => 'belum_dikerjakan']);
        DB::table('task')->where('status', 'done')->update(['status' => 'selesai']);

        DB::statement("ALTER TABLE `task` MODIFY COLUMN `status` ENUM('belum_dikerjakan', 'selesai') NOT NULL");
    }
};
