<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchByActivityTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'activityTypeId' => 'integer|exists:activity_types,id|required_without:query',
            'query' => 'string|nullable|required_without:activityTypeId',
        ];
    }
}
