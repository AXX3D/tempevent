<h1>Registration confirmed</h1>
<p>Hello {{ $registration->full_name }},</p>
<p>Your registration for <strong>{{ $registration->event->title }}</strong> has been recorded.</p>
<p>Event date: {{ $registration->event->starts_at->format('F j, Y, g:i A') }}</p>
<p>Location: {{ $registration->event->location }}</p>
