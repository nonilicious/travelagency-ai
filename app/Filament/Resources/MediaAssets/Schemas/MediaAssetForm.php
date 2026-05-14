<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('uploaded_by')
                    ->relationship('uploader', 'name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('alt_text'),
                FileUpload::make('path')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('media-library')
                    ->visibility('public'),
                TextInput::make('mime_type'),
                TextInput::make('size')
                    ->numeric(),
                TextInput::make('collection')
                    ->required()
                    ->default('gallery'),
            ]);
    }
}
