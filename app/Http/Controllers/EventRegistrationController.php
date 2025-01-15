<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;
use App\Services\EventRegistrationService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{

    use ApiResponse;

    public function __construct(protected EventRegistrationService $eventRegistrationService) {}


    public function register(EventRegistrationRequest $request)
    {

        try {

            $this->eventRegistrationService->register($request->event_id, $request->user_id);

            return $this->success(message: 'Event registered successfully', code: 201);

        } catch (\Throwable $th) {

            throw $th;

            return $this->error(message: 'An error occurred', code: 500);
        }
    }
}
