<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GajiResource\Pages;
use App\Models\Gaji;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GajiResource extends Resource
{
    protected static ?string $model = Gaji::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('karyawan_id')
                    ->label('Karyawan')
                    ->options(Karyawan::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('gaji_pokok')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('tunjangan')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('bonus')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('potongan')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_gaji')
                    ->numeric()
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('bulan')
                    ->required(),
                Forms\Components\TextInput::make('tahun')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('karyawan.nama')->label('Karyawan')->searchable(),
                Tables\Columns\TextColumn::make('gaji_pokok')->money('IDR', true),
                Tables\Columns\TextColumn::make('tunjangan')->money('IDR', true),
                Tables\Columns\TextColumn::make('bonus')->money('IDR', true),
                Tables\Columns\TextColumn::make('potongan')->money('IDR', true),
                Tables\Columns\TextColumn::make('total_gaji')->money('IDR', true),
                Tables\Columns\TextColumn::make('bulan'),
                Tables\Columns\TextColumn::make('tahun'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGajis::route('/'),
            'create' => Pages\CreateGaji::route('/create'),
            'edit' => Pages\EditGaji::route('/{record}/edit'),
        ];
    }
}
