<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('country')
                    ->required(),
                TextInput::make('region'),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('summary')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
                FileUpload::make('hero_image_path')
                    ->image()
                    ->disk('public')
                    ->directory('destinations')
                    ->visibility('public'),
                FileUpload::make('gallery_image_paths')
                    ->label('Gallery images')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->disk('public')
                    ->directory('destinations/gallery')
                    ->visibility('public')
                    ->columnSpanFull(),
                TagsInput::make('highlights')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
