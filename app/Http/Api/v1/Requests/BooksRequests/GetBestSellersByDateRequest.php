<?php

namespace App\Http\Api\v1\Requests\BooksRequests;

use App\Http\Api\BaseRequest;

class GetBestSellersByDateRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'list' => 'required|string|max:255',
            'date' => 'required|date|date_format:Y-m-d',
            'offset' => 'nullable|integer|min:0|multiple_of:20',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'list.required' => 'Parameter "list" is required.',
            'list.string' => 'Parameter "list" must be string.',
            'list.max' => 'Parameter "list" must be less than 255 characters.',
            'date.required' => 'Parameter "date" is required.',
            'date.date' => 'Parameter "date" must be a date.',
            'date.date_format' => 'Parameter "date" must be format Y-m-d.',
            'offset.integer' => 'Parameter "offset" must be an integer.',
            'offset.min' => 'Parameter "offset" must be greater than or equal to 0.',
            'offset.multiple_of' => 'Parameter "offset" must be a multiple of 20',
        ];
    }

    /**
     * @return array
     */
    public function filtered(): array
    {
        return $this->camelCaseKeys($this->only(['date', 'offset', 'list']));
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'list' => $this->route('list'),
            'date' => $this->route('date'),
        ]);
    }
}
