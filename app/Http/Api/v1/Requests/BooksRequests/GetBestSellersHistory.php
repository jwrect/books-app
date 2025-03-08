<?php

namespace App\Http\Api\v1\Requests\BooksRequests;

use App\Http\Api\BaseRequest;

class GetBestSellersHistory extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'age-group' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'contributor' => 'nullable|string|max:255',
            'isbn' => [
                'nullable',
                'array',
            ],
            'isbn.*' => [
                'string',
                'regex:/^(\d{10}|\d{13})$/'
            ],
            'offset' => 'nullable|integer|min:0|multiple_of:20',
            'price' => [
                'nullable',
                'string',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'publisher' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'age-group.string' => 'Parameter "age-group" must be a string.',
            'age-group.max' => 'Parameter "age-group" must be less than 255 characters.',
            'author.string' => 'Parameter "author" must be a string.',
            'author.max' => 'Parameter "author" must be less than 255 characters.',
            'contributor.string' => 'Parameter "contributor" must be a string.',
            'contributor.max' => 'Parameter "contributor" must be less than 255 characters.',
            'isbn.array' => 'Parameter "isbn" must be an array.',
            'isbn.*.regex' => 'Each isbn must be a string with 10 or 13 digits.',
            'offset.integer' => 'Parameter "offset" must be an integer.',
            'offset.min' => 'Parameter "offset" must be greater than or equal to 0.',
            'offset.multiple_of' => 'Parameter "offset" must be a multiple of 20',
            'price.string' => 'Parameter "price" must be a string.',
            'price.regex' => 'Parameter "price" must be a string float including decimal point.',
            'publisher.string' => 'Parameter "publisher" must be a string.',
            'publisher.max' => 'Parameter "publisher" must be less than 255 characters.',
            'title.string' => 'Parameter "title" must be a string.',
            'title.max' => 'Parameter "title" must be less than 255 characters.',
        ];
    }

    /**
     * @return array
     */
    public function filtered(): array
    {
        return $this->camelCaseKeys($this->only([
            'age-group', 'author', 'contributor', 'isbn', 'offset', 'price', 'publisher', 'title'
        ]));
    }
}
