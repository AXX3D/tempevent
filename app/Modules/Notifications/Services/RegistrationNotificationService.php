<?php

namespace App\Modules\Notifications\Services;

use App\Modules\Notifications\Contracts\NotificationSender;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Registrations\Models\Registration;

class RegistrationNotificationService
{
    public function __construct(private readonly NotificationSender $sender) {}

    public function sendConfirmation(Registration $registration): Notification
    {
        $notification = Notification::create([
            'registration_id' => $registration->id,
            'channel' => 'email',
            'recipient' => $registration->email,
            'status' => 'pending',
        ]);

        $result = $this->sender->sendRegistrationConfirmation($registration->load('event'));

        $notification->update([
            'status' => $result['status'],
            'provider_message_id' => $result['provider_message_id'] ?? null,
            'failure_reason' => $result['failure_reason'] ?? null,
            'attempted_at' => now(),
        ]);

        return $notification->refresh();
    }
}
