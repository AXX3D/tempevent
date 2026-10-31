@extends('layouts.app')

@section('title', 'Rate ' . $event->title . ' — TempEvent')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">← Back to event</a>
    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm sm:p-10">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Event feedback</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">How was {{ $event->title }}?</h1>
        <p class="mt-3 leading-7 text-slate-600">Your feedback helps organizers improve future events. This form is available to registered participants.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('events.feedback.store', $event) }}" class="mt-8 space-y-7">
            @csrf
            <div>
                <label class="text-sm font-semibold text-slate-800">Your rating</label>
                <div class="mt-3 flex flex-row-reverse justify-end gap-2">
                    @for ($score = 5; $score >= 1; $score--)
                        <input class="peer sr-only" type="radio" id="rating-{{ $score }}" name="rating" value="{{ $score }}" {{ (int) old('rating') === $score ? 'checked' : '' }} required>
                        <label for="rating-{{ $score }}" class="cursor-pointer text-4xl text-slate-300 transition hover:text-amber-400 peer-checked:text-amber-400 peer-checked:[&~label]:text-amber-400">★<span class="sr-only">{{ $score }} {{ $score === 1 ? 'star' : 'stars' }}</span></label>
                    @endfor
                </div>
            </div>
            <div>
                <label for="email" class="text-sm font-semibold text-slate-800">Registration email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="The email used during registration">
            </div>
            <div>
                <label for="comment" class="text-sm font-semibold text-slate-800">What did you think? <span class="font-normal text-slate-500">(optional)</span></label>
                <textarea id="comment" name="comment" rows="5" maxlength="2000" class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Share a highlight or suggestion...">{{ old('comment') }}</textarea>
            </div>
            <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Submit feedback</button>
        </form>
    </div>
</div>
@endsection
