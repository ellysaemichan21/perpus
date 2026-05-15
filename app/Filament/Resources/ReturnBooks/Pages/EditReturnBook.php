<?php

namespace App\Filament\Resources\ReturnBooks\Pages;

use App\Filament\Resources\ReturnBooks\ReturnBookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReturnBook extends EditRecord
{
    protected static string $resource = ReturnBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
