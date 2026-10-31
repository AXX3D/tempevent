@extends('layouts.app')

@section('title', $event->title . ' — TempEvent')

@section('content')
<a href="{{ route('events.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">← Back to events</a>
<div class="mt-6 grid gap-8 lg:grid-cols-[1fr_360px]">
    <section class="rounded-3xl bg-slate-900 p-8 text-white shadow-xl lg:p-12">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Event details</p>
        <h1 class="mt-5 text-4xl font-bold tracking-tight lg:text-5xl">{{ $event->title }}</h1>
        <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">{{ $event->description }}</p>
    </section>
    <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Register for this event</h2>
        @if (session('registration_success'))
            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm leading-6 text-emerald-800">
                {{ session('registration_success') }}
            </div>
        @else
            <p class="mt-2 text-sm text-slate-500">Reserve your place by providing your name and email address.</p>
            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                    <p class="font-semibold">Please review your details.</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('events.registrations.store', $event) }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="full_name" class="text-sm font-semibold text-slate-800">Full name</label>
                    <input id="full_name" name="full_name" value="{{ old('full_name') }}" required maxlength="120" class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Juan Dela Cruz">
                </div>
                <div>
                    <label for="email" class="text-sm font-semibold text-slate-800">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="juan@example.com">
                </div>
                <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Register for event</button>
            </form>
        @endif
        <dl class="mt-6 space-y-4 border-y border-slate-100 py-5 text-sm">
            <div><dt class="font-semibold text-slate-900">When</dt><dd class="mt-1 text-slate-600">{{ $event->starts_at->format('F j, Y · g:i A') }}</dd></div>
            <div><dt class="font-semibold text-slate-900">Where</dt><dd class="mt-1 text-slate-600">{{ $event->location }}</dd></div>
            <div><dt class="font-semibold text-slate-900">Capacity</dt><dd class="mt-1 text-slate-600">{{ $event->capacity ? $event->capacity . ' participants' : 'No limit specified' }}</dd></div>
        </dl>
        @if ($event->ends_at->isPast())
            @if (session('rating_success'))
                <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">{{ session('rating_success') }}</div>
            @else
                <a href="{{ route('events.feedback.create', $event) }}" class="mt-6 block w-full rounded-lg border border-indigo-200 bg-indigo-50 px-4 py-3 text-center text-sm font-semibold text-indigo-700 hover:bg-indigo-100">Rate this event</a>
            @endif
        @endif
    </aside>
</div>
@endsection
