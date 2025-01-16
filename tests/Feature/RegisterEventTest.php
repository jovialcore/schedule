<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Database\Factories\EventFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterEventTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    protected $baseUri  = 'api/event';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_that_user_can_register_for_an_event()
    {

        $event = Event::factory()->create();

        $user = User::factory()->create();

        $this->postJson(route('events.register', $event->id), [
            'user_id' => $user->id
        ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['status' => 201]);
    }

    public function test_that_user_can_not_register_for_an_event_that_has_reached_max_participants()
    {

        $event = Event::factory()->create([

            'max_num_of_participants' => 7

        ]);

        $user = User::factory()->count(8)->create();
        $event->participants()->attach($user->pluck('id'));
        $newUser  = User::Factory()->create();

        $this->postJson($this->baseUri . "/register/$event->id", [

            ...$event->toArray(),
            'user_id' => $newUser->id

        ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['status' => 500]);
    }


    public function test_that_user_registration_does_not_overlap()
    {
        $event = Event::factory()->create([
            'start_at' => now()->subDay(),
            'end_at' => now()->addDay(),
        ]);

        $users = User::factory()->count(4)->create();

        $event->participants()->attach($users->pluck('id'));

        $newUser = User::factory()->create();

        Event::factory()->create([
            'start_at' => now(),
            'end_at' => now()->copy()->addDay(),
        ])->participants()->attach($newUser->id);

        
        $response = $this->postJson(route('events.register', $event->id), [
            'user_id' => $newUser->id,
        ]);

        $response->assertStatus(Response::HTTP_OK)
        ->assertJsonFragment(['status' => 500])
            ->assertJson([
                'message' => 'You have an event that is overlapping with the event you want to attend'
            ]);
    }
}
