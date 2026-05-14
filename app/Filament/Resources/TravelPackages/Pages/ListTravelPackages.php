<?php

namespace App\Filament\Resources\TravelPackages\Pages;

use App\Filament\Resources\TravelPackages\TravelPackageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTravelPackages extends ListRecords
{
    protected static string $resource = TravelPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
