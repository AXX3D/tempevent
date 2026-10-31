<?php

namespace App\Modules\Notifications\Contracts;

use App\Modules\Registrations\Models\Registration;

interface NotificationSender
{
    /**
     * @return array{status: 'accepted'|'failed', provider_message_id?: string, failure_reason?: string}
     */
    public function sendRegistrationConfirmation(Registration $registration): array;
}
