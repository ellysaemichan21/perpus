<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Make jenis_kelamin nullable so registration doesn't require it
        DB::statement("ALTER TABLE members MODIFY jenis_kelamin ENUM('L', 'P') NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE members MODIFY jenis_kelamin ENUM('L', 'P') NOT NULL");
    }
};
