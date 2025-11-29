<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id'    => 'required|exists:authors,id',
            'description'  => 'nullable|string',
            'year'         => 'required|integer|min:1900|max:'.(date('Y')+1),
            'pages'        => 'nullable|integer|min:1',
            'cover'        => 'nullable|image|max:2048',
        ];

        if ($this->isMethod('POST')) {
            $rules['pdf_file']      = 'required|mimes:pdf|max:20480';
            $rules['license_count'] = 'required|integer|min:1|max:50';
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['pdf_file'] = 'nullable|mimes:pdf|max:20480';
        }

        return $rules;
    }
}