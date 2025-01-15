<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterEventTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     protected $baseUrl  = '/register-event';

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_that_user_can_register_for_an_event(){

    } 

    public function test_that_user_can_not_register_for_an_event_that_has_reached_max_participants(){

    }

    public function test_that_user_cannot_register_for_an_event_that_has_already_started(){

    }

    public function test_that_user_cannot_register_for_an_event_that_has_already_ended(){

    }

    public function test_that_user_cannot_register_an_old_event(){

    }

    public function test_that_user_cannot_register_for_their_own_event(){

    }

    public function test_that_events_can_be_retrieved(){

    }

    public function test_that_events_can_be_retrieved_by_id(){

    }

}
