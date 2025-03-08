<?php

namespace App\Http\Api\v1\Requests\BooksRequests;


use App\Http\Api\BaseRequest;

class GetBookReviewsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'author' => 'nullable|string|max:255',
            'isbn' => [
                'nullable',
                'string',
                'regex:/^(\d{10}|\d{13})(;\d{10}|\d{13})*$/'
            ],
            'title' => 'nullable|string|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'author.string' => 'Parameter "author" must be a string.',
            'isbn.string' => 'Parameter "isbn" must be a string.',
            'title.string' => 'Parameter "title" must be a string.',
            'author.max' => 'Parameter "author" must not be greater than 255 characters.',
            'title.max' => 'Parameter "title" must not be greater than 255 characters.',
            'isbn.regex' => 'Parameter "isbn" must be a string with 10- or 13-digit.',
        ];
    }

    /**
     * @return array
     */
    public function filtered(): array
    {
        return $this->camelCaseKeys($this->only(['author', 'isbn', 'title']));
    }
}
