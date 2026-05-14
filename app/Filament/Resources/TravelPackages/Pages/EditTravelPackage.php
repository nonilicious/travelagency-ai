<?php

namespace App\Filament\Resources\TravelPackages\Pages;

use App\Filament\Resources\TravelPackages\TravelPackageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTravelPackage extends EditRecord
{
    protected static string $resource = TravelPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
