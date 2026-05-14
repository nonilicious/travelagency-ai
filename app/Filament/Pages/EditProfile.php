<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_path')
                    ->label('Profile photo')
                    ->avatar()
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public'),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                Select::make('preferred_locale')
                    ->label('Default language')
                    ->options(config('app.supported_locales'))
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('company')
                    ->maxLength(255),
                Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    protected function getRedirectUrl(): ?string
    {
        return static::getUrl();
    }

    protected function getNameFormComponent(): Component
    {
        return parent::getNameFormComponent()->columnSpan(1);
    }
}
