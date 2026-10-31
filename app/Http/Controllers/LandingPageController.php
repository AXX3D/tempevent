<?php

namespace App\Http\Controllers;

use App\Modules\Events\Models\Event;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        $upcomingEvents = Event::query()
            ->where('status', 'published')
            ->where('starts_at', '>=', now()->startOfDay())
            ->orderBy('starts_at')
            ->limit(3)
            ->get();

        return view('landing', compact('upcomingEvents'));
    }
}
