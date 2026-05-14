<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['itinerary_id', 'day_number', 'title', 'location', 'plan', 'activities', 'lodging_suggestions'])]
class ItineraryDay extends Model
{
    protected function casts(): array
    {
        return [
            'activities' => 'array',
            'lodging_suggestions' => 'array',
        ];
    }

    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }
}
