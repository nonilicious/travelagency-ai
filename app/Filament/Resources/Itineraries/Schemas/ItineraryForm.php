<?php

namespace App\Filament\Resources\Itineraries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItineraryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name'),
                Select::make('travel_package_id')
                    ->relationship('travelPackage', 'title'),
                TextInput::make('title')
                    ->required(),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'confirmed' => 'Confirmed',
                        'archived' => 'Archived',
                    ])
                    ->required()
                    ->default('draft'),
                TextInput::make('travelers')
                    ->required()
                    ->numeric()
                    ->default(2),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                TextInput::make('estimated_budget')
                    ->numeric(),
                Textarea::make('summary')
                    ->columnSpanFull(),
                KeyValue::make('agent_notes')
                    ->columnSpanFull(),
            ]);
    }
}
