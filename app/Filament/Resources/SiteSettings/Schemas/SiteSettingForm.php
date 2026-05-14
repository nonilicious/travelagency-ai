<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->default('home')
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('hero_eyebrow'),
                        TextInput::make('hero_title')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('hero_body')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('hero_image_path')
                            ->label('Hero image')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Hero buttons and metrics')
                    ->schema([
                        TextInput::make('primary_button_label'),
                        TextInput::make('secondary_button_label'),
                        TextInput::make('tertiary_button_label'),
                        TextInput::make('metric_one_value'),
                        TextInput::make('metric_one_label'),
                        TextInput::make('metric_two_value'),
                        TextInput::make('metric_two_label'),
                        TextInput::make('metric_three_value'),
                        TextInput::make('metric_three_label'),
                    ])
                    ->columns(3),
                Section::make('Hero panel')
                    ->schema([
                        TextInput::make('hero_panel_title'),
                        TextInput::make('hero_panel_body')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Content sections')
                    ->schema([
                        TextInput::make('destinations_heading')
                            ->columnSpanFull(),
                        Textarea::make('destinations_intro')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('packages_heading')
                            ->columnSpanFull(),
                        Textarea::make('packages_intro')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Section::make('Assistant section')
                    ->schema([
                        TextInput::make('assistant_eyebrow'),
                        TextInput::make('assistant_heading')
                            ->columnSpanFull(),
                        Textarea::make('assistant_body')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('assistant_prompt')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
