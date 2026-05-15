<?php

namespace App\Filament\Resources\Books;

use App\Filament\Resources\Books\Pages\ManageBooks;

use App\Models\Book;

use BackedEnum;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel =
        'Buku';

    protected static ?string $recordTitleAttribute =
        'judul';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('category_id')
                    ->relationship('category', 'nama_kategori')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('kode_buku')
                    ->required(),

                TextInput::make('judul')
                    ->required(),

                TextInput::make('penulis')
                    ->required(),

                TextInput::make('penerbit')
                    ->required(),

                TextInput::make('tahun_terbit')
                    ->numeric()
                    ->required(),

                TextInput::make('stok')
                    ->numeric()
                    ->required(),

                FileUpload::make('cover')
                    ->image()
                    ->directory('cover-buku')
                    ->disk('public')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('cover'),

                TextColumn::make('kode_buku')
                    ->label('Kode Buku'),

                TextColumn::make('judul')
                    ->searchable(),

                TextColumn::make('category.nama_kategori')
                    ->label('Kategori'),

                TextColumn::make('penulis'),

                TextColumn::make('stok')
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
                ManageBooks::route('/'),

        ];
    }
}