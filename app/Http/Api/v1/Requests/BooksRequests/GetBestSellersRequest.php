<?php

namespace App\Http\Api\v1\Requests\BooksRequests;

use App\Http\Api\BaseRequest;

class GetBestSellersRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'list' => 'required|string|max:255',
            'bestsellers-date' => 'nullable|date|date_format:Y-m-d',
            'published-date' => 'nullable|date|date_format:Y-m-d',
            'offset' => 'nullable|integer|min:0|multiple_of:20',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'bestsellers-date.date_format' => 'Parameter "bestsellers-date" date format must be Y-m-d.',
            'bestsellers-date.date' => 'Parameter "bestsellers-date" must be a date format.',
            'published-date.date' => 'Parameter "published-date" must be a date format.',
            'published-date.date_format' => 'Parameter "published-date" date format must be Y-m-d.',
            'list.required' => 'Parameter "list" is required.',
            'list.string' => 'Parameter "list" must be a string.',
            'list.max' => 'Parameter "list" must be less than 255.',
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
        return $this->camelCaseKeys($this->only(['bestsellers-date', 'published-date', 'offset', 'list']));
    }
}
