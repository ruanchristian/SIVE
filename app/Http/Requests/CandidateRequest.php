<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $rules = [
            'name' => 'required|min:2|max:30',
            'number' => 'required|numeric|min:10|max:99',
            'image' => 'required|image'
        ];

        if ($this->isMethod('PUT')) $rules['image'] = 'nullable|image';

        return $rules;
    }

    public function messages(): array {
        return [
            'name.min' => 'O nome da chapa precisa ter no mínimo 2 caracteres.',
            'name.max' => 'O nome da chapa só pode ter no máximo 30 caracteres.',
            'image.required' => 'A imagem da chapa é obrigatória!',
            'number.max' => 'O número da chapa só pode ter 2 dígitos.',
            'number.min' => 'O número da chapa só pode ter 2 dígitos.'
        ];
    }
}
