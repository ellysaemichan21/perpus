<?php

namespace App\Filament\Resources\Members;

use App\Filament\Resources\Members\Pages\ManageMembers;

use App\Models\Member;

use BackedEnum;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel =
        'Member';

    protected static ?string $recordTitleAttribute =
        'nama';

    // ================= FORM =================
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ================= USER =================
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                // ================= NAMA =================
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                // ================= NIM / NIP =================
                TextInput::make('nim_nip')
                    ->label('NIM / NIP')
                    ->required()
                    ->maxLength(255),

                // ================= JENIS KELAMIN =================
                Select::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-Laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                // ================= ALAMAT =================
                Textarea::make('alamat')
                    ->rows(3),

                // ================= NO HP =================
                TextInput::make('no_hp')
                    ->label('No HP')
                    ->tel()
                    ->maxLength(20),

            ]);
    }

    // ================= TABLE =================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // ================= USER =================
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                // ================= NAMA =================
                TextColumn::make('nama')
                    ->searchable(),

                // ================= NIM NIP =================
                TextColumn::make('nim_nip')
                    ->label('NIM / NIP'),

                // ================= JK =================
                TextColumn::make('jenis_kelamin')
                    ->formatStateUsing(fn ($state) =>
                        $state === 'L'
                            ? 'Laki-Laki'
                            : 'Perempuan'
                    ),

                // ================= NO HP =================
                TextColumn::make('no_hp'),

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
                ManageMembers::route('/'),

        ];
    }
}