@extends('layouts.app')

@section('title', 'Browse events — TempEvent')

@section('content')
<div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
    <div>
        <p class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Campus activities</p>
        <h1 class="text-4xl font-bold tracking-tight text-slate-950">Find your next event.</h1>
        <p class="mt-3 max-w-2xl text-lg text-slate-600">Discover seminars, workshops, and activities. Registration will be available from each event page.</p>
    </div>
    <div class="rounded-2xl bg-indigo-50 px-5 py-4 text-sm text-indigo-900">
        <span class="font-semibold">{{ $events->total() }}</span> upcoming published events
    </div>
</div>

@if ($events->isEmpty())
    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
        <h2 class="text-xl font-semibold">No upcoming events yet</h2>
        <p class="mt-2 text-slate-500">Organizers can publish the first event from the organizer view.</p>
    </div>
@else
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($events as $event)
            <article class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="h-2 bg-indigo-600"></div>
                <div class="flex flex-1 flex-col p-6">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div class="rounded-xl bg-indigo-50 px-3 py-2 text-center text-indigo-700">
                            <div class="text-xs font-bold uppercase">{{ $event->starts_at->format('M') }}</div>
                            <div class="text-2xl font-bold leading-none">{{ $event->starts_at->format('d') }}</div>
                        </div>
                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Open</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-950">{{ $event->title }}</h2>
                    <p class="mt-3 flex-1 text-sm leading-6 text-slate-600">{{ $event->description }}</p>
                    <div class="mt-6 space-y-2 border-t border-slate-100 pt-4 text-sm text-slate-500">
                        <p>📍 {{ $event->location }}</p>
                        <p>🕘 {{ $event->starts_at->format('g:i A') }} – {{ $event->ends_at->format('g:i A') }}</p>
                    </div>
                    <a href="{{ route('events.show', $event) }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">View event</a>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-8">{{ $events->links() }}</div>
@endif
@endsection
