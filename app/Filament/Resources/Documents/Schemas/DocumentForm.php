<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name'),
                Select::make('uploaded_by')
                    ->relationship('uploader', 'name'),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('path')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('customer-documents')
                    ->visibility('private')
                    ->required(),
                TextInput::make('mime_type')
                    ->required()
                    ->default('application/pdf'),
                TextInput::make('size')
                    ->numeric(),
                Toggle::make('is_visible_to_customer')
                    ->required(),
            ]);
    }
}
