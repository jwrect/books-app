<?php

namespace App\Http\Api\v1\Requests\BooksRequests;


use App\Http\Api\BaseRequest;
use Illuminate\Validation\Validator;

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
                'array',
            ],
            'isbn.*' => [
                'string',
                'regex:/^(\d{10}|\d{13})$/'
            ],
            'title' => 'nullable|string|max:255',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $filters = $this->query();
            if (empty(array_filter($filters, fn($value) => !is_null($value) && $value !== ''))) {
                $validator->errors()->add('general', 'This endpoint requires at least one parameter: title, author or isbn.');
            }

            if (isset($filters['isbn']) && is_array($filters['isbn']) && empty(array_filter($filters['isbn'], fn($value) => !is_null($value) && $value !== ''))) {
                $validator->errors()->add('isbn', 'The isbn array must contain at least one non-empty value.');
            }
        });
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'author.string' => 'Parameter "author" must be a string.',
            'title.string' => 'Parameter "title" must be a string.',
            'author.max' => 'Parameter "author" must not be greater than 255 characters.',
            'title.max' => 'Parameter "title" must not be greater than 255 characters.',
            'isbn.array' => 'Parameter "isbn" must be an array.',
            'isbn.*.regex' => 'Each isbn must be a string with 10 or 13 digits.',
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
