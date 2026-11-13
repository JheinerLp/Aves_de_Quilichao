<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicSightingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Formulario público
    }

    public function rules(): array
    {
        return [
            'observer_name' => ['required', 'string', 'max:100'],
            'observer_email' => ['required', 'email', 'max:150'],
            'species_id' => ['required', 'exists:species,id'],
            'location_id' => ['nullable', 'exists:locations,id'],
            'sighting_date' => ['required', 'date', 'before_or_equal:today'],
            'individuals_count' => ['required', 'integer', 'min:1', 'max:500'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'latitude' => ['nullable', 'numeric', 'between:2.5,3.5'],
            'longitude' => ['nullable', 'numeric', 'between:-77.0,-76.0'],
        ];
    }

    public function messages(): array
    {
        return [
            'observer_name.required' => 'El nombre del observador es obligatorio.',
            'observer_email.required' => 'El correo electrónico es obligatorio para validar el reporte.',
            'observer_email.email' => 'Debes ingresar una dirección de correo electrónico válida.',
            'species_id.required' => 'Debes seleccionar la especie observada.',
            'sighting_date.required' => 'La fecha de observación es obligatoria.',
            'sighting_date.before_or_equal' => 'La fecha no puede ser futura.',
            'individuals_count.required' => 'Indica la cantidad aproximada de ejemplares.',
            'description.required' => 'Por favor detalla brevemente el comportamiento y entorno del avistamiento.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        ];
    }
}
