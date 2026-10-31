<?php

namespace App\Modules\Notifications\Services;

use App\Modules\Notifications\Contracts\NotificationSender;
use App\Modules\Registrations\Models\Registration;
use Illuminate\Support\Facades\Http;
use Throwable;

class BrevoNotificationSender implements NotificationSender
{
    public function sendRegistrationConfirmation(Registration $registration): array
    {
        $apiKey = config('services.brevo.api_key');

        if (blank($apiKey)) {
            return [
                'status' => 'failed',
                'failure_reason' => 'Brevo API key is not configured.',
            ];
        }

        try {
            $response = Http::baseUrl(config('services.brevo.base_url'))
                ->withHeaders(['api-key' => $apiKey])
                ->acceptJson()
                ->timeout((float) config('services.brevo.timeout', 5.0))
                ->post('/smtp/email', [
                    'sender' => [
                        'email' => config('services.brevo.sender_email'),
                        'name' => config('services.brevo.sender_name'),
                    ],
                    'to' => [[
                        'email' => $registration->email,
                        'name' => $registration->full_name,
                    ]],
                    'subject' => "Registration confirmed: {$registration->event->title}",
                    'htmlContent' => view('emails.registration-confirmation', [
                        'registration' => $registration,
                    ])->render(),
                ]);

            if ($response->successful()) {
                return [
                    'status' => 'accepted',
                    'provider_message_id' => $response->json('messageId'),
                ];
            }

            return [
                'status' => 'failed',
                'failure_reason' => "Brevo returned HTTP {$response->status()}.",
            ];
        } catch (Throwable $exception) {
            report($exception);

            return [
                'status' => 'failed',
                'failure_reason' => 'Brevo notification request failed.',
            ];
        }
    }
}
