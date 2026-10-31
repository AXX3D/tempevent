<?php

namespace App\Modules\Feedback\Models;

use App\Modules\Events\Models\Event;
use App\Modules\Registrations\Models\Registration;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('event_ratings')]
#[Fillable(['event_id', 'registration_id', 'rating', 'comment'])]
class EventRating extends Model
{
    protected function casts(): array
    {
        return ['rating' => 'integer'];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
