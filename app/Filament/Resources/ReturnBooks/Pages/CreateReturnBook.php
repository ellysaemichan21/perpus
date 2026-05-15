<?php

namespace App\Filament\Resources\ReturnBooks\Pages;

use App\Filament\Resources\ReturnBooks\ReturnBookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReturnBook extends CreateRecord
{
    protected static string $resource = ReturnBookResource::class;

    /**
     * After a ReturnBook record is created:
     * 1. Update the parent Loan status to 'dikembalikan'
     * 2. Restore book stock for each LoanDetail
     */
    protected function afterCreate(): void
    {
        $returnBook = $this->record;
        $loan = $returnBook->loan;

        if ($loan) {

            // ================= UPDATE LOAN STATUS =================
            $loan->update([
                'status' => 'dikembalikan',
            ]);

            // ================= RESTORE BOOK STOCK =================
            foreach ($loan->loanDetails as $detail) {

                $detail->book->increment(
                    'stok',
                    $detail->jumlah
                );

            }
        }
    }
}
