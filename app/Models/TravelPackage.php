<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['destination_id', 'title', 'slug', 'teaser', 'description', 'duration_days', 'price_from', 'currency', 'cover_image_path', 'included_services', 'travel_styles', 'is_featured', 'is_published'])]
class TravelPackage extends Model
{
    protected function casts(): array
    {
        return [
            'included_services' => 'array',
            'travel_styles' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'price_from' => 'decimal:2',
        ];
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(Itinerary::class);
    }
}
