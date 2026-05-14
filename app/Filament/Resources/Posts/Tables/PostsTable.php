<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                IconColumn::make('ai_generated')
                    ->boolean()
                    ->label('AI'),
                ImageColumn::make('cover_image_path'),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Post $record): string => route('admin.preview.posts.show', $record))
                    ->openUrlInNewTab(),
                Action::make('sendToReview')
                    ->label('Send to review')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->visible(fn (Post $record): bool => $record->status !== Post::STATUS_PUBLISHED)
                    ->action(function (Post $record): void {
                        $record->markInReview();

                        Notification::make()
                            ->success()
                            ->title('Post moved to review')
                            ->send();
                    }),
                Action::make('approvePublish')
                    ->label('Approve & publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Post $record): bool => $record->status !== Post::STATUS_PUBLISHED)
                    ->action(function (Post $record): void {
                        $record->publishReviewedBy(auth()->user());

                        Notification::make()
                            ->success()
                            ->title('Post published')
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
