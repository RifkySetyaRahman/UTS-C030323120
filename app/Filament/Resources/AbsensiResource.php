<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('karyawan_id')
                    ->label('Karyawan')
                    ->options(Karyawan::pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Select::make('status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Alpha' => 'Alpha',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('jam_masuk')
                    ->label('Jam Masuk')
                    ->time(),
                Forms\Components\TextInput::make('jam_keluar')
                    ->label('Jam Keluar')
                    ->time(),
                Forms\Components\Textarea::make('keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('karyawan.nama')->label('Karyawan')->searchable(),
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('jam_masuk')->time(),
                Tables\Columns\TextColumn::make('jam_keluar')->time(),
                Tables\Columns\TextColumn::make('keterangan'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Alpha' => 'Alpha',
                    ]),
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
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
