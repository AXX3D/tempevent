<?php

namespace App\Modules\Registrations\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Events\Models\Event;
use App\Modules\Notifications\Services\RegistrationNotificationService;
use App\Modules\Registrations\Http\Requests\StoreRegistrationRequest;
use App\Modules\Registrations\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function store(
        StoreRegistrationRequest $request,
        Event $event,
        RegistrationNotificationService $notifications,
    ): RedirectResponse
    {
        abort_unless($event->isPublished(), 404);

        $registration = DB::transaction(function () use ($request, $event): Registration {
            return Registration::create([
                'event_id' => $event->id,
                'full_name' => $request->string('full_name')->trim()->toString(),
                'email' => $request->string('email')->lower()->trim()->toString(),
                'status' => 'registered',
            ]);
        });

        $notifications->sendConfirmation($registration);

        return to_route('events.show', $event)
            ->with('registration_success', 'You are registered. Your confirmation notification is being processed separately.');
    }
}
