<?php

namespace App\Modules\Events\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Events\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::query()
            ->where('status', 'published')
            ->where('starts_at', '>=', now()->startOfDay())
            ->orderBy('starts_at')
            ->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        abort_unless($event->isPublished(), 404);

        return view('events.show', compact('event'));
    }

    public function manage(): View
    {
        $events = Event::query()->orderByDesc('starts_at')->paginate(10);

        return view('events.manage', compact('events'));
    }
}
