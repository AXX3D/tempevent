@extends('layouts.app')

@section('title', 'TempEvent — Discover what is happening')

@section('content')
<section class="relative overflow-hidden rounded-[2rem] bg-slate-950 px-8 py-16 text-white shadow-2xl lg:px-16 lg:py-24">
    <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-indigo-500/30 blur-3xl"></div>
    <div class="absolute -bottom-32 left-1/3 h-80 w-80 rounded-full bg-cyan-500/20 blur-3xl"></div>
    <div class="relative max-w-3xl">
        <p class="mb-5 text-sm font-semibold uppercase tracking-[0.25em] text-indigo-300">One place for every activity</p>
        <h1 class="text-5xl font-bold tracking-tight sm:text-6xl lg:text-7xl">Make time for what matters.</h1>
        <p class="mt-7 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">TempEvent makes it simple to discover campus events, reserve your place, and stay informed from registration to confirmation.</p>
        <div class="mt-10 flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('events.index') }}" class="rounded-xl bg-indigo-500 px-6 py-3.5 text-center text-sm font-bold text-white shadow-lg shadow-indigo-950/40 transition hover:bg-indigo-400">Explore upcoming events</a>
            <a href="#how-it-works" class="rounded-xl border border-slate-700 px-6 py-3.5 text-center text-sm font-bold text-slate-200 transition hover:border-slate-500 hover:bg-slate-900">How it works</a>
        </div>
    </div>
</section>

<section class="grid gap-6 py-16 md:grid-cols-3">
    <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl">✦</div>
        <h2 class="mt-6 text-xl font-bold">Discover</h2>
        <p class="mt-3 leading-7 text-slate-600">Find seminars, workshops, forums, and activities in one clear event catalogue.</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50 text-xl">✓</div>
        <h2 class="mt-6 text-xl font-bold">Register</h2>
        <p class="mt-3 leading-7 text-slate-600">Reserve a place with a short, focused registration form built for participants.</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl">↗</div>
        <h2 class="mt-6 text-xl font-bold">Stay informed</h2>
        <p class="mt-3 leading-7 text-slate-600">Receive registration confirmations and important event updates in one connected workflow.</p>
    </div>
</section>

<section id="how-it-works" class="grid items-center gap-12 rounded-[2rem] bg-indigo-50 px-8 py-12 lg:grid-cols-2 lg:px-16">
    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Built for campus communities</p>
        <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Less searching. More participating.</h2>
        <p class="mt-5 leading-8 text-slate-600">Whether you are joining an activity or organizing one, TempEvent keeps the essential details together so everyone can focus on the experience.</p>
    </div>
    <div class="space-y-4">
        <div class="flex gap-4 rounded-2xl bg-white p-5 shadow-sm"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">1</span><div><h3 class="font-bold">Choose an event</h3><p class="mt-1 text-sm leading-6 text-slate-600">Browse published activities and open the details that interest you.</p></div></div>
        <div class="flex gap-4 rounded-2xl bg-white p-5 shadow-sm"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">2</span><div><h3 class="font-bold">Send your registration</h3><p class="mt-1 text-sm leading-6 text-slate-600">Provide your name and email so organizers can keep an accurate participant list.</p></div></div>
        <div class="flex gap-4 rounded-2xl bg-white p-5 shadow-sm"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">3</span><div><h3 class="font-bold">Get confirmation</h3><p class="mt-1 text-sm leading-6 text-slate-600">Your registration is recorded first, with notification delivery handled separately.</p></div></div>
    </div>
</section>

<section class="py-16">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div><p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Coming up</p><h2 class="mt-2 text-3xl font-bold tracking-tight">Find something worth attending.</h2></div>
        <a href="{{ route('events.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800">View all events →</a>
    </div>
    @if ($upcomingEvents->isNotEmpty())
        <div class="mt-8 grid gap-5 md:grid-cols-3">
            @foreach ($upcomingEvents as $event)
                <a href="{{ route('events.show', $event) }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-4"><span class="text-sm font-bold uppercase text-indigo-600">{{ $event->starts_at->format('M d') }}</span><span class="text-slate-400 transition group-hover:translate-x-1">→</span></div>
                    <h3 class="mt-8 text-xl font-bold group-hover:text-indigo-700">{{ $event->title }}</h3>
                    <p class="mt-3 text-sm text-slate-500">{{ $event->location }}</p>
                </a>
            @endforeach
        </div>
    @else
        <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">New events will appear here soon.</div>
    @endif
</section>

<section class="rounded-[2rem] bg-slate-900 px-8 py-12 text-center text-white lg:px-16">
    <h2 class="text-3xl font-bold">Ready to take part?</h2>
    <p class="mx-auto mt-3 max-w-xl text-slate-300">Explore the event catalogue and find your next opportunity to learn, connect, and contribute.</p>
    <a href="{{ route('events.index') }}" class="mt-7 inline-flex rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-slate-900 hover:bg-indigo-50">Browse events</a>
</section>
@endsection
