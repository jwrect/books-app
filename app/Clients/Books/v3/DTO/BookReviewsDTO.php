<?php

namespace App\Clients\Books\v3\DTO;

final class BookReviewsDTO extends BooksDTO
{
    /**
     * @param array|null $isbn
     * @param string|null $title
     * @param string|null $author
     */
    public function __construct(
        protected readonly array|null $isbn = null,
        protected readonly string|null $title = null,
        protected readonly string|null $author = null,
    ) {
        parent::__construct();
    }

    /**
     * @return array|string[]
     */
    protected function getRules(): array
    {
        return parent::getRules() + [
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
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = $this->getObjectVars();

        if (isset($data['isbn']) && is_array($data['isbn'])) {
            $data['isbn'] = implode(';', $data['isbn']);
        }

        return array_filter($data, fn($value) => !is_null($value));
    }
}
