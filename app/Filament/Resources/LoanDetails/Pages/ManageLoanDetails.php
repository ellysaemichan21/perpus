<?php

namespace App\Filament\Resources\LoanDetails\Pages;

use App\Filament\Resources\LoanDetails\LoanDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoanDetails extends ManageRecords
{
    protected static string $resource = LoanDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
