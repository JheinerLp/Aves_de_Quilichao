<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSightingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Models\Sighting::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'species_id' => ['required', 'exists:species,id'],
            'location_id' => ['nullable', 'exists:locations,id'],
            'habitat_id' => ['nullable', 'exists:habitats,id'],
            'sighting_date' => ['required', 'date', 'before_or_equal:today'],
            'sighting_time' => ['nullable', 'date_format:H:i'],
            'individuals_count' => ['required', 'integer', 'min:1', 'max:500'],
            'latitude' => ['required', 'numeric', 'between:2.5,3.5'],
            'longitude' => ['required', 'numeric', 'between:-77.0,-76.0'],
            'description' => ['nullable', 'string', 'max:1500'],
            'photos.*' => ['nullable', 'image', 'max:10240'],
        ];
    }
}
