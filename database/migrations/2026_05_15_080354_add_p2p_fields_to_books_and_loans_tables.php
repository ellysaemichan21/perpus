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
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->constrained('members')->nullOnDelete();
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->decimal('escrow_amount', 10, 2)->default(0);
            $table->string('p2p_status')->default('pending_deposit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['escrow_amount', 'p2p_status']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });
    }
};
