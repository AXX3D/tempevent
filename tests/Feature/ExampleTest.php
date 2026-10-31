<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Events\Models\Event;
use App\Modules\Registrations\Models\Registration;
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

    public function test_a_participant_can_register_for_a_published_event(): void
    {
        $event = Event::create([
            'title' => 'Test Workshop',
            'slug' => 'test-workshop',
            'description' => 'A test event.',
            'location' => 'Test Hall',
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'capacity' => 50,
            'status' => 'published',
        ]);

        $response = $this->post(route('events.registrations.store', $event), [
            'full_name' => 'Maria Santos',
            'email' => 'maria@example.com',
        ]);

        $response->assertRedirect(route('events.show', $event));
        $this->assertDatabaseHas('registrations', [
            'event_id' => $event->id,
            'email' => 'maria@example.com',
            'status' => 'registered',
        ]);
        $this->assertDatabaseHas('notifications', [
            'registration_id' => $event->registrations()->first()->id,
            'status' => 'failed',
        ]);
    }

    public function test_a_registered_participant_can_rate_a_completed_event(): void
    {
        $event = Event::create([
            'title' => 'Completed Workshop',
            'slug' => 'completed-workshop',
            'description' => 'A completed test event.',
            'location' => 'Test Hall',
            'starts_at' => now()->subDays(2),
            'ends_at' => now()->subDay(),
            'capacity' => 50,
            'status' => 'published',
        ]);
        $registration = Registration::create([
            'event_id' => $event->id,
            'full_name' => 'Maria Santos',
            'email' => 'maria@example.com',
            'status' => 'registered',
        ]);

        $response = $this->post(route('events.feedback.store', $event), [
            'email' => $registration->email,
            'rating' => 5,
            'comment' => 'Excellent workshop.',
        ]);

        $response->assertRedirect(route('events.show', $event));
        $this->assertDatabaseHas('event_ratings', [
            'event_id' => $event->id,
            'registration_id' => $registration->id,
            'rating' => 5,
            'comment' => 'Excellent workshop.',
        ]);
    }
}
