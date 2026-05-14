<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'country', 'region', 'slug', 'summary', 'description', 'hero_image_path', 'highlights', 'is_featured', 'is_published'])]
class Destination extends Model
{
    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function travelPackages(): HasMany
    {
        return $this->hasMany(TravelPackage::class);
    }
}
