<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Events\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Event::updateOrCreate(['slug' => 'student-leadership-summit'], [
            'created_by' => $user->id,
            'title' => 'Student Leadership Summit',
            'description' => 'A practical afternoon of talks and workshops for student leaders.',
            'location' => 'FEU Tech Innovation Center',
            'starts_at' => Carbon::now()->addDays(10)->setTime(9, 0),
            'ends_at' => Carbon::now()->addDays(10)->setTime(16, 0),
            'capacity' => 120,
            'status' => 'published',
        ]);

        Event::updateOrCreate(['slug' => 'design-thinking-workshop'], [
            'created_by' => $user->id,
            'title' => 'Design Thinking Workshop',
            'description' => 'Learn how to turn real campus problems into tested ideas.',
            'location' => 'Room 504, FEU Tech',
            'starts_at' => Carbon::now()->addDays(18)->setTime(13, 30),
            'ends_at' => Carbon::now()->addDays(18)->setTime(17, 0),
            'capacity' => 60,
            'status' => 'published',
        ]);

        Event::updateOrCreate(['slug' => 'community-technology-forum'], [
            'created_by' => $user->id,
            'title' => 'Community Technology Forum',
            'description' => 'An open forum on responsible technology and community impact.',
            'location' => 'FEU Tech Auditorium',
            'starts_at' => Carbon::now()->addDays(25)->setTime(10, 0),
            'ends_at' => Carbon::now()->addDays(25)->setTime(12, 30),
            'capacity' => 250,
            'status' => 'published',
        ]);
    }
}
