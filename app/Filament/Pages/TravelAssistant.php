<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class TravelAssistant extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Travel Assistant';

    protected static string|\UnitEnum|null $navigationGroup = 'AI';

    protected string $view = 'filament.pages.travel-assistant';
}
