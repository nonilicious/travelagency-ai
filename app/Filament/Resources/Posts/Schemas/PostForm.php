<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('author', 'name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('cover_image_path')
                    ->image()
                    ->disk('public')
                    ->directory('posts')
                    ->visibility('public'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
