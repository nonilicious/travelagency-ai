<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Post;
use App\Models\TravelPackage;
use App\Models\User;
use App\Mail\CustomerInquiryConfirmation;
use App\Mail\CustomerInquiryReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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

    public function test_customer_can_send_contact_request_without_account(): void
    {
        Mail::fake();

        User::factory()->create([
            'role' => 'admin',
            'email' => 'agency@example.com',
        ]);

        $response = $this->post(route('contact.store'), [
            'name' => 'Mara Test',
            'email' => 'mara@example.com',
            'phone' => '+43 123',
            'destination_interest' => 'Italy coast',
            'travelers' => 2,
            'preferred_start_date' => '2026-07-01',
            'preferred_end_date' => '2026-07-10',
            'budget' => 4500,
            'message' => 'We want a calm premium trip with sea views.',
        ]);

        $response->assertRedirect(route('contact.create'));

        $this->assertDatabaseHas('customer_inquiries', [
            'email' => 'mara@example.com',
            'destination_interest' => 'Italy coast',
            'status' => 'new',
        ]);

        Mail::assertSent(CustomerInquiryReceived::class, fn (CustomerInquiryReceived $mail) => $mail->hasTo('agency@example.com'));
        Mail::assertSent(CustomerInquiryConfirmation::class, fn (CustomerInquiryConfirmation $mail) => $mail->hasTo('mara@example.com'));
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
            'status' => Post::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        $this->get(route('posts.show', $post))
            ->assertStatus(200)
            ->assertSee('A better itinerary')
            ->assertSee('Useful detail for travelers', false);
    }

    public function test_admin_can_preview_unpublished_ai_post(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $post = Post::create([
            'user_id' => $admin->id,
            'title' => 'AI draft about Sicily',
            'slug' => 'ai-draft-about-sicily',
            'excerpt' => 'A draft excerpt.',
            'body' => '<p>Draft body for review.</p>',
            'status' => Post::STATUS_DRAFT_AI,
            'ai_generated' => true,
            'ai_prompt' => 'Write a travel article about Sicily.',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.preview.posts.show', $post))
            ->assertStatus(200)
            ->assertSee('Admin preview')
            ->assertSee('AI generated')
            ->assertSee('Draft body for review', false);
    }

    public function test_customer_cannot_preview_admin_post_draft(): void
    {
        $customer = User::factory()->create();
        $post = Post::create([
            'title' => 'Hidden draft',
            'slug' => 'hidden-draft',
            'excerpt' => 'Hidden.',
            'body' => '<p>Hidden body.</p>',
            'status' => Post::STATUS_DRAFT_AI,
        ]);

        $this->actingAs($customer)
            ->get(route('admin.preview.posts.show', $post))
            ->assertForbidden();
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
