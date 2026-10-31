<?php

namespace App\Modules\Events\Models;

use App\Models\User;
use App\Modules\Registrations\Models\Registration;
use App\Modules\Feedback\Models\EventRating;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('events')]
#[Fillable([
    'title',
    'slug',
    'description',
    'location',
    'starts_at',
    'ends_at',
    'capacity',
    'status',
    'created_by',
])]
class Event extends Model
{
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'capacity' => 'integer',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(EventRating::class);
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
