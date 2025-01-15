<?php

namespace App\Services;

use App\Models\Event;

class EventRegistrationService
{
    public function register(int $eventId, int $userId): void
    {

        $event = Event::find($eventId);
        $event->participants()->attach($userId);
    }
}
