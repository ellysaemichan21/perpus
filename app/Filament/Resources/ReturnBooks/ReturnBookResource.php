<?php

namespace App\Filament\Resources\ReturnBooks;

use App\Filament\Resources\ReturnBooks\Pages\CreateReturnBook;
use App\Filament\Resources\ReturnBooks\Pages\EditReturnBook;
use App\Filament\Resources\ReturnBooks\Pages\ListReturnBooks;

use App\Models\ReturnBook;

use BackedEnum;

use Carbon\Carbon;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReturnBookResource extends Resource
{
    protected static ?string $model = ReturnBook::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowUturnLeft;

    protected static ?string $recordTitleAttribute =
        'Return Book';

    // ================= FORM =================
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ================= LOAN =================
                Select::make('loan_id')
                    ->relationship(
                        'loan',
                        'id',
                        fn ($query) => $query
                            ->where('status', 'dipinjam')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) =>
                            "#{$record->id} — "
                            . ($record->member?->nama ?? 'N/A')
                            . " ({$record->tanggal_pinjam})"
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive(),

                // ================= TANGGAL DIKEMBALIKAN =================
                DatePicker::make('tanggal_dikembalikan')
                    ->required()
                    ->reactive()

                    ->afterStateUpdated(function ($state, callable $set, callable $get) {

                        $loan = \App\Models\Loan::find(
                            $get('loan_id')
                        );

                        if ($loan) {

                            $tanggalKembali = Carbon::parse(
                                $loan->tanggal_kembali
                            );

                            $tanggalDikembalikan = Carbon::parse(
                                $state
                            );

                            // ================= HITUNG TERLAMBAT =================
                            $terlambat =
                                $tanggalDikembalikan->greaterThan($tanggalKembali)

                                ? $tanggalKembali->diffInDays($tanggalDikembalikan)

                                : 0;

                            // ================= SET TERLAMBAT =================
                            $set(
                                'terlambat_hari',
                                $terlambat
                            );

                            // ================= DENDA =================
                            $denda = $terlambat * 5000;

                            $set(
                                'denda',
                                $denda
                            );

                            // ================= STATUS =================
                            $set(
                                'status',
                                $terlambat > 0
                                    ? 'terlambat'
                                    : 'dikembalikan'
                            );
                        }
                    }),

                // ================= TERLAMBAT =================
                TextInput::make('terlambat_hari')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                // ================= DENDA =================
                TextInput::make('denda')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                // ================= STATUS =================
                TextInput::make('status')
                    ->disabled()
                    ->dehydrated(),

            ]);
    }

    // ================= TABLE =================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('loan.id')
                    ->label('Loan ID'),

                TextColumn::make('tanggal_dikembalikan')
                    ->date(),

                TextColumn::make('terlambat_hari'),

                TextColumn::make('denda')
                    ->money('IDR', true),

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

    // ================= PAGES =================
    public static function getPages(): array
    {
        return [

            'index' =>
                ListReturnBooks::route('/'),

            'create' =>
                CreateReturnBook::route('/create'),

            'edit' =>
                EditReturnBook::route('/{record}/edit'),

        ];
    }
}