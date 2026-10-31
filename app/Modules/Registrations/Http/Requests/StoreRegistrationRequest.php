<?php

namespace App\Modules\Registrations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
                Rule::unique('registrations', 'email')->where(
                    fn ($query) => $query->where('event_id', $this->route('event')->id)
                ),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'full name',
        ];
    }
}
