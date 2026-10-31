<?php

namespace App\Modules\Feedback\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $event = $this->route('event');

        return [
            'email' => [
                'required',
                'email:rfc',
                Rule::exists('registrations', 'email')->where(
                    fn ($query) => $query->where('event_id', $event->id)
                ),
            ],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'Only registered participants can submit feedback for this event.',
        ];
    }
}
