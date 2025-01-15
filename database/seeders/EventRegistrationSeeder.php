<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Scheduler;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedulers = Event::factory()->count(10)->create();

        $events  = Event::factory()->count(10)->create();

        $schedulers->each(function ($schedulers) {

            $schedulers->participants()->CreateMany(User::factory()->count(10)->create());
        });
    }
}
