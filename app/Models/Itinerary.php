<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_id', 'travel_package_id', 'title', 'status', 'travelers', 'start_date', 'end_date', 'estimated_budget', 'summary', 'agent_notes'])]
class Itinerary extends Model
{
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'estimated_budget' => 'decimal:2',
            'agent_notes' => 'array',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function travelPackage(): BelongsTo
    {
        return $this->belongsTo(TravelPackage::class);
    }

    public function days(): HasMany
    {
        return $this->hasMany(ItineraryDay::class);
    }
}
