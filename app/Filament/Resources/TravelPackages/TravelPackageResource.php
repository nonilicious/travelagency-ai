<?php

namespace App\Filament\Resources\TravelPackages;

use App\Filament\Resources\TravelPackages\Pages\CreateTravelPackage;
use App\Filament\Resources\TravelPackages\Pages\EditTravelPackage;
use App\Filament\Resources\TravelPackages\Pages\ListTravelPackages;
use App\Filament\Resources\TravelPackages\Schemas\TravelPackageForm;
use App\Filament\Resources\TravelPackages\Tables\TravelPackagesTable;
use App\Models\TravelPackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TravelPackageResource extends Resource
{
    protected static ?string $model = TravelPackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $navigationLabel = 'Travel Packages';

    protected static string|\UnitEnum|null $navigationGroup = 'Sales';

    public static function form(Schema $schema): Schema
    {
        return TravelPackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TravelPackagesTable::configure($table);
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
            'index' => ListTravelPackages::route('/'),
            'create' => CreateTravelPackage::route('/create'),
            'edit' => EditTravelPackage::route('/{record}/edit'),
        ];
    }
}
