<?php

namespace App\Http\Api\v1\Requests\BooksRequests;

use App\Http\Api\BaseRequest;

class GetTopFiveBooksRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'published_date' => 'date|date_format:Y-m-d',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'published_date.date' => 'Parameter "published_date" must be a date.',
            'published_date.date_format' => 'Parameter "published_date" format is invalid. Must be Y-m-d.',
        ];
    }

    /**
     * @return array
     */
    public function filtered(): array
    {
        return $this->camelCaseKeys($this->only(['published_date']));
    }
}
