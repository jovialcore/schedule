<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Exception;

class EventRegistrationService
{
    public function allEvents()
    {
        return Event::all();
    }

    public function register(int $eventId, int $userId): void
    {
        $event = Event::findOrFail($eventId);

        $this->canParticipate($event, $userId);

        $event->participants()->attach($userId);
    }

    public function getEvent(Event $event): Event
    {
        return $event;
    }

    public function eventMaxParticipantReached(Event $event): bool
    {
        return $event->participants()->count() >= $event->max_num_of_participants;
    }

    public function userHasOverlappingEvents(Event $event, int $userId): bool
    {


       return User::findOrFail($userId)
            ->events()
            ->where(function ($query) use ($event) {
                $query->where(function ($q) use ($event) {
                    $q->where('start_at', '<=', $event->start_at)
                        ->where('end_at', '>=', $event->start_at);
                })->orWhere(function ($q) use ($event) {
                    $q->where('start_at', '<=', $event->end_at)
                        ->where('end_at', '>=', $event->end_at);
                });
            })
            ->exists();

        
    }

    public function canParticipate(Event $event, int $userId): bool
    {
        if ($this->eventMaxParticipantReached($event)) {
            throw new Exception('Event has reached maximum number of participants');
        }

        if ($this->userHasOverlappingEvents($event, $userId)) {

            throw new Exception('You have an event that is overlapping with the event you want to attend');
        }

        return true;
    }
}
