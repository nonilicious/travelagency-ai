<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Content')
                    ->schema([
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
                    ])
                    ->columns(2),
                Section::make('Review workflow')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft_ai' => 'AI draft',
                                'draft_manual' => 'Manual draft',
                                'in_review' => 'In review',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()
                            ->default('draft_manual'),
                        Toggle::make('ai_generated')
                            ->label('AI generated'),
                        TextInput::make('ai_model')
                            ->label('AI model'),
                        Textarea::make('ai_prompt')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('ai_notes')
                            ->rows(3)
                            ->columnSpanFull(),
                        DateTimePicker::make('published_at'),
                    ])
                    ->columns(2),
            ]);
    }
}
