<?php

namespace App\Modules\Notifications\Models;

use App\Modules\Registrations\Models\Registration;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('notifications')]
#[Fillable([
    'registration_id',
    'channel',
    'recipient',
    'status',
    'provider_message_id',
    'failure_reason',
    'attempted_at',
])]
class Notification extends Model
{
    protected function casts(): array
    {
        return ['attempted_at' => 'datetime'];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
