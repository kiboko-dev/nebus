<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:point,polygon,rectangle',
            'point' => 'required_if:type,point|array|size:2',
            'point.lat' => 'required_if:type,point|numeric|between:-90,90',
            'point.lng' => 'required_if:type,point|numeric|between:-180,180',
            'rectangle' => 'required_if:type,rectangle|array|size:2',
            'rectangle.ltp' => 'required_if:type,rectangle|array|size:2',
            'rectangle.rbp' => 'required_if:type,rectangle|array|size:2',
            'rectangle.*.lat' => 'required|numeric|between:-90,90',
            'rectangle.*.lng' => 'required|numeric|between:-180,180',
            'polygon' => 'required_if:type,polygon|array|size:4',
            'polygon.*' => 'required|array|size:2',
            'polygon.*.lat' => 'required|numeric|between:-90,90',
            'polygon.*.lng' => 'required|numeric|between:-180,180',
            'radius'    =>  'required_if:type,point|numeric',
        ];
    }
}
