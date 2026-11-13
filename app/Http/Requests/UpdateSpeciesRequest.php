<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSpeciesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('species')) ?? false;
    }

    public function rules(): array
    {
        $speciesId = $this->route('species')?->id;

        return [
            'common_name' => ['required', 'string', 'max:150'],
            'scientific_name' => ['required', 'string', 'max:150', Rule::unique('species', 'scientific_name')->ignore($speciesId)],
            'family_id' => ['required', 'exists:families,id'],
            'habitat_id' => ['nullable', 'exists:habitats,id'],
            'category' => ['required', 'string', 'in:residente,endemica,migratoria,amenazada,vulnerable'],
            'uicn_status' => ['required', 'string', 'in:LC,NT,VU,EN,CR,EW,EX,DD,NE'],
            'description' => ['required', 'string'],
            'physical_characteristics' => ['nullable', 'string'],
            'diet' => ['nullable', 'string'],
            'behavior' => ['nullable', 'string'],
            'distribution' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }
}
