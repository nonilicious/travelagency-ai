<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'key',
    'hero_eyebrow',
    'hero_title',
    'hero_body',
    'hero_image_path',
    'primary_button_label',
    'secondary_button_label',
    'tertiary_button_label',
    'metric_one_value',
    'metric_one_label',
    'metric_two_value',
    'metric_two_label',
    'metric_three_value',
    'metric_three_label',
    'hero_panel_title',
    'hero_panel_body',
    'destinations_heading',
    'destinations_intro',
    'packages_heading',
    'packages_intro',
    'assistant_eyebrow',
    'assistant_heading',
    'assistant_body',
    'assistant_prompt',
])]
class SiteSetting extends Model
{
    public static function home(): self
    {
        return static::query()->firstOrCreate(
            ['key' => 'home'],
            static::defaults(),
        );
    }

    public static function defaults(): array
    {
        return [
            'hero_eyebrow' => 'Modern premium travel agency',
            'hero_title' => 'Tailor-made journeys, planned with human taste and AI speed.',
            'hero_body' => 'A Laravel and Filament travel platform for curated destinations, public travel inspiration, inquiry handling and an admin assistant that helps craft better trips.',
            'hero_image_path' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1100&q=80',
            'primary_button_label' => 'Open Admin',
            'secondary_button_label' => 'Send request',
            'tertiary_button_label' => 'View Packages',
            'metric_one_value' => '7',
            'metric_one_label' => 'core admin modules',
            'metric_two_value' => 'AI',
            'metric_two_label' => 'assistant workspace planned',
            'metric_three_value' => 'Mail',
            'metric_three_label' => 'inquiry email flow',
            'hero_panel_title' => 'Next sprint: contact assistant',
            'hero_panel_body' => 'A guided request flow that prepares inquiries for the agency and confirms them by email.',
            'destinations_heading' => 'Curated places for high-intent travelers.',
            'destinations_intro' => 'Destinations are managed in Filament and can be featured, published and connected to packages.',
            'packages_heading' => 'Package concepts ready for itinerary building.',
            'packages_intro' => 'Each package can carry duration, price, services and travel style metadata for the assistant.',
            'assistant_eyebrow' => 'Admin assistant',
            'assistant_heading' => 'From request to polished itinerary draft.',
            'assistant_body' => 'The assistant area starts as a guided workspace. Next we connect it to destinations, packages and incoming inquiries, then wire in AI tools for route planning and offer drafts.',
            'assistant_prompt' => 'Create a 10-day Japan itinerary for two travelers, budget 4,500 EUR, focus on culture, food and calm boutique hotels.',
        ];
    }

    public function imageUrl(string $attribute): ?string
    {
        $path = $this->getAttribute($attribute);

        if (! $path) {
            return null;
        }

        return str($path)->startsWith(['http://', 'https://'])
            ? $path
            : '/storage/'.$path;
    }
}
