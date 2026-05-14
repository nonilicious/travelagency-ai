<?php

namespace App\Filament\Resources\CustomerInquiries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('destination_interest'),
                TextInput::make('travelers')
                    ->required()
                    ->numeric()
                    ->default(2),
                DatePicker::make('preferred_start_date'),
                DatePicker::make('preferred_end_date'),
                TextInput::make('budget')
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'new' => 'New',
                        'qualified' => 'Qualified',
                        'proposal_sent' => 'Proposal sent',
                        'won' => 'Won',
                        'lost' => 'Lost',
                    ])
                    ->required()
                    ->default('new'),
                Textarea::make('message')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
