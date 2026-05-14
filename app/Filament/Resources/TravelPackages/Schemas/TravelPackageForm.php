<?php

namespace App\Filament\Resources\TravelPackages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TravelPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('destination_id')
                    ->relationship('destination', 'name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('teaser')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
                TextInput::make('duration_days')
                    ->required()
                    ->numeric()
                    ->default(7),
                TextInput::make('price_from')
                    ->numeric(),
                TextInput::make('currency')
                    ->required()
                    ->default('EUR'),
                FileUpload::make('cover_image_path')
                    ->image()
                    ->disk('public')
                    ->directory('packages')
                    ->visibility('public'),
                TagsInput::make('included_services')
                    ->columnSpanFull(),
                TagsInput::make('travel_styles')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
