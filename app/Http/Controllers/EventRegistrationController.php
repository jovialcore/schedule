<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventRegistrationService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{

    use ApiResponse;

    public function __construct(protected EventRegistrationService $eventRegistrationService) {}


    public function index()
    {
        try {

            $events = $this->eventRegistrationService->allEvents();

            $events = EventResource::collection($events);

            return $this->success($events, 'Events retrieved successfully', 200);
        } catch (\Throwable $th) {

            return $this->error(message: 'An error occurred', code: 500);
        }
    }

    public function register(Request $request, $eventId)
    {

        try {

            $this->eventRegistrationService->register($eventId, $request->user_id);

            return $this->success(message: 'Event registered successfully', code: 201);
        } catch (\Exception $e) {


            return $this->error(message: $e->getMessage(), code: 500);
        }
    }

    public function show(Event $eventName)
    {
        try {

            $event = $this->eventRegistrationService->getEvent($eventName);

            $event =  new EventResource($event->load('participants'));

            return $this->success($event, 'Event retrieved successfully', 200);
        } catch (\Throwable $th) {

            return $this->error(message: 'An error occurred', code: 500);
        }
    }
}
