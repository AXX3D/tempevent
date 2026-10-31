@extends('layouts.app')

@section('title', 'Manage events — TempEvent')

@section('content')
<div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Organizer workspace</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-950">Manage events</h1>
        <p class="mt-3 text-slate-600">A single place to review event status and participant capacity.</p>
    </div>
    <button disabled class="cursor-not-allowed rounded-lg bg-slate-200 px-4 py-3 text-sm font-semibold text-slate-500">Create event coming next</button>
</div>
<div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[720px] text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                <tr><th class="px-6 py-4">Event</th><th class="px-6 py-4">Schedule</th><th class="px-6 py-4">Location</th><th class="px-6 py-4">Status</th><th class="px-6 py-4"></th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($events as $event)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-5"><div class="font-semibold text-slate-900">{{ $event->title }}</div><div class="mt-1 text-xs text-slate-500">Capacity: {{ $event->capacity ?? 'Unlimited' }}</div></td>
                        <td class="px-6 py-5 text-slate-600">{{ $event->starts_at->format('M j, Y') }}<br><span class="text-xs">{{ $event->starts_at->format('g:i A') }}</span></td>
                        <td class="px-6 py-5 text-slate-600">{{ $event->location }}</td>
                        <td class="px-6 py-5"><span class="rounded-full px-3 py-1 text-xs font-semibold {{ $event->isPublished() ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ ucfirst($event->status) }}</span></td>
                        <td class="px-6 py-5 text-right"><a href="{{ route('events.show', $event) }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Preview →</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">No events have been created yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-100 px-6 py-4">{{ $events->links() }}</div>
</div>
@endsection
