<?php

namespace App\Filament\Resources\LoanDetails;

use App\Filament\Resources\LoanDetails\Pages\ManageLoanDetails;

use App\Models\LoanDetail;
use App\Models\Book;

use BackedEnum;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Table;

class LoanDetailResource extends Resource
{
    protected static ?string $model = LoanDetail::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel =
        'Detail Peminjaman';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('loan_id')
                    ->relationship('loan', 'id')
                    ->required(),

                Select::make('book_id')
                    ->relationship('book', 'judul')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()

                    ->afterStateUpdated(function ($state, callable $set) {

                        $book = Book::find($state);

                        if ($book) {

                            $set('stok', $book->stok);

                        }

                    }),

                TextInput::make('stok')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('jumlah')
                    ->numeric()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('loan_id')
                    ->label('ID Pinjam'),

                TextColumn::make('loan.member.nama')
                    ->label('Member'),

                TextColumn::make('book.judul')
                    ->label('Buku'),

                TextColumn::make('jumlah'),

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
                ManageLoanDetails::route('/'),

        ];
    }
}