<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FichajeResource\Pages;
use App\Filament\Resources\FichajeResource\RelationManagers;
use App\Models\Fichaje;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;

class FichajeResource extends Resource
{
    protected static ?string $model = Fichaje::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('empleado.nombre')
                ->sortable(),
                Tables\Columns\TextColumn::make('empleado.turno')
                ->sortable()
                ->label('Turno'),
                Tables\Columns\TextColumn::make('entrada')
                ->dateTime()
                ->sortable(),
                Tables\Columns\TextColumn::make('salida')
                ->dateTime()
                ->sortable(),
                Tables\Columns\TextColumn::make('tarde')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    '1' => 'danger',
                    '0' => 'success',
                    'rejected' => 'danger',
                })
                ->sortable(),

            ])
            ->filters([
                DateFilter::make('entrada'),
                DateFilter::make('salida')

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFichajes::route('/'),
            'create' => Pages\CreateFichaje::route('/create'),
            'edit' => Pages\EditFichaje::route('/{record}/edit'),
        ];
    }
}
