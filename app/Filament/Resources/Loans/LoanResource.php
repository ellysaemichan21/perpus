<?php

namespace App\Filament\Resources\Loans;

use App\Filament\Resources\Loans\Pages\ManageLoans;

use App\Models\Loan;

use BackedEnum;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Table;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel =
        'Peminjaman';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('member_id')
                    ->relationship('member', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('tanggal_pinjam')
                    ->required(),

                DatePicker::make('tanggal_kembali')
                    ->required(),

                Select::make('status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                    ])
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('member.nama')
                    ->label('Member'),

                TextColumn::make('user.name')
                    ->label('Petugas'),

                TextColumn::make('tanggal_pinjam')
                    ->date(),

                TextColumn::make('tanggal_kembali')
                    ->date(),

                TextColumn::make('status')
                    ->badge(),

            ])

            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [

            'index' =>
                ManageLoans::route('/'),

        ];
    }
}