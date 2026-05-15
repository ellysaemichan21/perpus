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
        Schema::create('return_books', function (Blueprint $table) {

            $table->id();

            // RELASI KE LOANS
            $table->foreignId('loan_id')
                  ->constrained('loans')
                  ->cascadeOnDelete();

            // TANGGAL DIKEMBALIKAN
            $table->date('tanggal_dikembalikan');

            // TERLAMBAT
            $table->integer('terlambat_hari')
                  ->default(0);

            // DENDa
            $table->decimal('denda', 12, 2)
                  ->default(0);

            // STATUS
            $table->enum('status', [
                'dikembalikan',
                'terlambat'
            ]);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_books');
    }
};