<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Post;
use App\Models\TravelPackage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_authenticated_customer_can_view_profile(): void
    {
        $user = User::factory()->create([
            'preferred_locale' => 'de',
        ]);

        $this->actingAs($user)
            ->get('/profile')
            ->assertStatus(200)
            ->assertSee('Profil');
    }

    public function test_authenticated_admin_can_view_filament_profile(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get('/admin/profile')
            ->assertStatus(200)
            ->assertSee('Default language');
    }

    public function test_public_post_detail_is_available(): void
    {
        $author = User::factory()->create();
        $post = Post::create([
            'user_id' => $author->id,
            'title' => 'A better itinerary',
            'slug' => 'a-better-itinerary',
            'excerpt' => 'A short travel planning note.',
            'body' => '<p>Useful detail for travelers.</p>',
            'published_at' => now(),
        ]);

        $this->get(route('posts.show', $post))
            ->assertStatus(200)
            ->assertSee('A better itinerary')
            ->assertSee('Useful detail for travelers', false);
    }

    public function test_public_package_detail_is_available(): void
    {
        $package = TravelPackage::create([
            'title' => 'Amalfi Slow Luxury',
            'slug' => 'amalfi-slow-luxury',
            'teaser' => 'A slow premium coast journey.',
            'description' => '<p>Private transfers, sea views and curated restaurants.</p>',
            'duration_days' => 7,
            'price_from' => 3100,
            'currency' => 'EUR',
            'included_services' => ['Private transfers'],
            'travel_styles' => ['Luxury'],
            'is_published' => true,
        ]);

        $this->get(route('packages.show', $package))
            ->assertStatus(200)
            ->assertSee('Amalfi Slow Luxury')
            ->assertSee('Private transfers, sea views and curated restaurants', false);
    }

    public function test_public_destination_detail_is_available(): void
    {
        $destination = Destination::create([
            'name' => 'Kyoto',
            'country' => 'Japan',
            'slug' => 'kyoto',
            'summary' => 'Temples, gardens and quiet hotels.',
            'description' => '<p>Tea houses, markets and calm cultural days.</p>',
            'highlights' => ['Private tea ceremony'],
            'gallery_image_paths' => ['https://example.com/kyoto.jpg'],
            'is_published' => true,
        ]);

        $this->get(route('destinations.show', $destination))
            ->assertStatus(200)
            ->assertSee('Kyoto')
            ->assertSee('Private tea ceremony')
            ->assertSee('Tea houses, markets and calm cultural days', false);
    }
}
