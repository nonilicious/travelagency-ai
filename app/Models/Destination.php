<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'country', 'region', 'slug', 'summary', 'description', 'hero_image_path', 'gallery_image_paths', 'highlights', 'is_featured', 'is_published'])]
class Destination extends Model
{
    protected function casts(): array
    {
        return [
            'gallery_image_paths' => 'array',
            'highlights' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function travelPackages(): HasMany
    {
        return $this->hasMany(TravelPackage::class);
    }

    public function imageUrl(): ?string
    {
        if (! $this->hero_image_path) {
            return null;
        }

        return str($this->hero_image_path)->startsWith(['http://', 'https://'])
            ? $this->hero_image_path
            : '/storage/'.$this->hero_image_path;
    }

    public function galleryImageUrls(): array
    {
        return collect($this->gallery_image_paths ?? [])
            ->map(fn (string $path): string => str($path)->startsWith(['http://', 'https://'])
                ? $path
                : '/storage/'.$path)
            ->all();
    }
}
