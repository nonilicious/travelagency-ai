<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\TravelPackage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['key' => 'home'],
            SiteSetting::defaults(),
        );

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@travelagency.test'],
            [
                'name' => 'Travel Agency Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'customer@travelagency.test'],
            [
                'name' => 'Mira Sommer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
        );

        $kyoto = Destination::query()->updateOrCreate(
            ['slug' => 'kyoto-japan'],
            [
                'name' => 'Kyoto',
                'country' => 'Japan',
                'region' => 'Kansai',
                'summary' => 'Tempelgaerten, Teehaeuser und ruhige Boutique-Hotels in Japans kulturellem Herz.',
                'description' => 'Eine kuratierte Reise fuer Gaeste, die Kultur, Kulinarik und ruhige Luxusmomente verbinden wollen.',
                'hero_image_path' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80',
                'gallery_image_paths' => [
                    'https://images.unsplash.com/photo-1528360983277-13d401cdc186?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?auto=format&fit=crop&w=1200&q=80',
                ],
                'highlights' => ['Private Teezeremonie', 'Nishiki Market Tour', 'Ryokan mit Onsen'],
                'is_featured' => true,
                'is_published' => true,
            ],
        );

        $amalfi = Destination::query()->updateOrCreate(
            ['slug' => 'amalfi-coast-italy'],
            [
                'name' => 'Amalfi Coast',
                'country' => 'Italien',
                'region' => 'Kampanien',
                'summary' => 'Zitronenhaine, Bootstage und kleine Hotels mit weitem Blick ueber das Tyrrhenische Meer.',
                'description' => 'Premium-Reisen entlang der Kueste mit Fokus auf Kulinarik, Designhotels und entspannte Transfers.',
                'hero_image_path' => 'https://images.unsplash.com/photo-1533104816931-20fa691ff6ca?auto=format&fit=crop&w=1200&q=80',
                'gallery_image_paths' => [
                    'https://images.unsplash.com/photo-1612698093158-e07ac200d44e?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1566837497312-7be4a00f7f70?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1516483638261-f4dbaf036963?auto=format&fit=crop&w=1200&q=80',
                ],
                'highlights' => ['Privates Boot nach Capri', 'Dinner in Ravello', 'Limoncello-Verkostung'],
                'is_featured' => true,
                'is_published' => true,
            ],
        );

        $iceland = Destination::query()->updateOrCreate(
            ['slug' => 'south-iceland'],
            [
                'name' => 'South Iceland',
                'country' => 'Island',
                'region' => 'Suederland',
                'summary' => 'Design-Lodges, Gletscherlagunen und stille Naturerlebnisse zwischen Feuer und Eis.',
                'description' => 'Eine hochwertige Outdoor-Reise mit privaten Guides, Fotostopps und komfortablen Lodges.',
                'hero_image_path' => 'https://images.unsplash.com/photo-1504829857797-ddff29c27927?auto=format&fit=crop&w=1200&q=80',
                'gallery_image_paths' => [
                    'https://images.unsplash.com/photo-1520769945061-0a448c463865?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1476610182048-b716b8518aae?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=1200&q=80',
                ],
                'highlights' => ['Private Glacier Walk', 'Northern Lights Check', 'Geothermal Spa'],
                'is_featured' => false,
                'is_published' => true,
            ],
        );

        TravelPackage::query()->updateOrCreate(
            ['slug' => 'japan-culture-cuisine'],
            [
                'destination_id' => $kyoto->id,
                'title' => 'Japan Culture & Cuisine',
                'teaser' => '10 Tage Tokio, Kyoto und Osaka mit kulinarischem Fokus und ruhigen Premium-Stays.',
                'description' => 'Ein ausgewogener Reiseentwurf fuer Paare und kleine Gruppen, die tief eintauchen moechten, ohne gehetzt zu reisen.',
                'duration_days' => 10,
                'price_from' => 4200,
                'currency' => 'EUR',
                'cover_image_path' => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?auto=format&fit=crop&w=1200&q=80',
                'included_services' => ['Boutique-Hotels', 'Rail Pass', 'Private Food Tour', 'Concierge Support'],
                'travel_styles' => ['Culture', 'Food', 'Premium'],
                'is_featured' => true,
                'is_published' => true,
            ],
        );

        TravelPackage::query()->updateOrCreate(
            ['slug' => 'amalfi-slow-luxury'],
            [
                'destination_id' => $amalfi->id,
                'title' => 'Amalfi Slow Luxury',
                'teaser' => '7 Tage Kueste, Capri und Ravello mit privaten Transfers und genussvollen Pausen.',
                'description' => 'Ein sonniger Reiseplan fuer anspruchsvolle Gaeste, die Meer, Kulinarik und Designhotels suchen.',
                'duration_days' => 7,
                'price_from' => 3100,
                'currency' => 'EUR',
                'cover_image_path' => 'https://images.unsplash.com/photo-1612698093158-e07ac200d44e?auto=format&fit=crop&w=1200&q=80',
                'included_services' => ['Private Transfers', 'Boutique-Hotel', 'Boat Day', 'Restaurant Booking'],
                'travel_styles' => ['Coast', 'Romance', 'Luxury'],
                'is_featured' => true,
                'is_published' => true,
            ],
        );

        TravelPackage::query()->updateOrCreate(
            ['slug' => 'iceland-elements'],
            [
                'destination_id' => $iceland->id,
                'title' => 'Iceland Elements',
                'teaser' => '8 Tage Natur, Spa und private Guides entlang der spektakulaeren Suedkueste.',
                'description' => 'Fuer Reisende, die Naturkraft mit Komfort verbinden wollen.',
                'duration_days' => 8,
                'price_from' => 3600,
                'currency' => 'EUR',
                'cover_image_path' => 'https://images.unsplash.com/photo-1520769945061-0a448c463865?auto=format&fit=crop&w=1200&q=80',
                'included_services' => ['4x4 Rental', 'Private Guide Day', 'Design Lodges', 'Spa Entry'],
                'travel_styles' => ['Nature', 'Adventure', 'Design'],
                'is_featured' => false,
                'is_published' => true,
            ],
        );

        Post::query()->updateOrCreate(
            ['slug' => 'how-we-design-itineraries'],
            [
                'user_id' => $admin->id,
                'title' => 'How We Design Itineraries',
                'excerpt' => 'Warum gute Reiseplanung mehr ist als eine Liste schoener Orte.',
                'body' => 'Wir kombinieren Timing, Wege, Energielevel, lokale Expertise und persoenliche Vorlieben zu Reiseplaenen, die sich leicht anfuehlen.',
                'cover_image_path' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
            ],
        );
    }
}
