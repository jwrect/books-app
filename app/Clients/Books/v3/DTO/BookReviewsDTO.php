<?php

namespace App\Clients\Books\v3\DTO;

final class BookReviewsDTO extends BooksDTO
{
    public function __construct(
        private readonly string|null $isbn,
        private readonly string|null $title,
        private readonly string|null $author,
    ) {
        parent::__construct();
    }

    protected function getRules(): array
    {
        return parent::getRules() + [
            'author' => 'nullable|string|max:255',
            'isbn' => [
                'nullable',
                'string',
                'regex:/^(\d{10}|\d{13})(;\d{10}|\d{13})*$/'
            ],
            'title' => 'nullable|string|max:255',
        ];
    }
}
