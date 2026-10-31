<?php

namespace App\Modules\Feedback\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Events\Models\Event;
use App\Modules\Feedback\Http\Requests\StoreEventRatingRequest;
use App\Modules\Feedback\Models\EventRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventRatingController extends Controller
{
    public function create(Event $event): View
    {
        abort_unless($event->ends_at->isPast(), 404);

        return view('feedback.create', compact('event'));
    }

    public function store(StoreEventRatingRequest $request, Event $event): RedirectResponse
    {
        abort_unless($event->ends_at->isPast(), 404);

        $registration = $event->registrations()
            ->where('email', $request->string('email')->lower()->trim()->toString())
            ->firstOrFail();

        if (EventRating::where('registration_id', $registration->id)->exists()) {
            return back()->withErrors(['email' => 'You have already submitted feedback for this event.'])->withInput();
        }

        EventRating::create([
            'event_id' => $event->id,
            'registration_id' => $registration->id,
            'rating' => $request->integer('rating'),
            'comment' => $request->string('comment')->trim()->toString() ?: null,
        ]);

        return to_route('events.show', $event)
            ->with('rating_success', 'Thank you. Your feedback has been recorded.');
    }
}
