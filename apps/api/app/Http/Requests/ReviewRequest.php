<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
        public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'comment' => [
                'required',
                'string',
                'max:500',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'O produto obrigatório.',
            'product_id.integer' => 'O ID do produto deve ser um número inteiro.',
            'product_id.exists' => 'O produto informado não existe.',

            'customer_id.required' => 'O cliente é obrigatório.',
            'customer_id.integer' => 'O ID do cliente deve ser um número inteiro.',
            'customer_id.exists' => 'O cliente informado não existe.',

            'rating.required' => 'A nota é obrigatória.',
            'rating.integer' => 'A nota deve ser um número inteiro.',
            'rating.between' => 'A nota deve estar entre 1 e 5.',

            'comment.required' => 'O comentário é obrigatório.',
            'comment.string' => 'O comentário deve ser um texto.',
            'comment.max' => 'O comentário não pode possuir mais de 500 caracteres.',
        ];
    }
}
