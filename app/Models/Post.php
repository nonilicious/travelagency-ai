<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'title', 'slug', 'excerpt', 'body', 'status', 'ai_generated', 'ai_prompt', 'ai_model', 'ai_notes', 'reviewed_by', 'reviewed_at', 'cover_image_path', 'published_at'])]
class Post extends Model
{
    public const STATUS_DRAFT_AI = 'draft_ai';

    public const STATUS_DRAFT_MANUAL = 'draft_manual';

    public const STATUS_IN_REVIEW = 'in_review';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_ARCHIVED = 'archived';

    protected function casts(): array
    {
        return [
            'ai_generated' => 'boolean',
            'reviewed_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function markInReview(): void
    {
        $this->update([
            'status' => self::STATUS_IN_REVIEW,
        ]);
    }

    public function publishReviewedBy(User $user): void
    {
        $this->update([
            'status' => self::STATUS_PUBLISHED,
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'published_at' => $this->published_at ?? now(),
        ]);
    }

    public function imageUrl(): ?string
    {
        if (! $this->cover_image_path) {
            return null;
        }

        return str($this->cover_image_path)->startsWith(['http://', 'https://'])
            ? $this->cover_image_path
            : '/storage/'.$this->cover_image_path;
    }
}
