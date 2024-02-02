<?php

namespace App\Filament\Resources\FichajeResource\Pages;

use App\Filament\Resources\FichajeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFichaje extends EditRecord
{
    protected static string $resource = FichajeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
