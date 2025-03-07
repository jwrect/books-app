<?php

namespace App\Clients\Books\v3\DTO;

final class BestSellersHistoryDTO extends BooksDTO
{
    /**
     * @param string|null $ageGroup
     * @param string|null $author
     * @param string|null $contributor
     * @param string|null $isbn
     * @param int|null $offset
     * @param string|null $price
     * @param string|null $publisher
     * @param string|null $title
     */
    public function __construct(
        private readonly string|null $ageGroup,
        private readonly string|null $author,
        private readonly string|null $contributor,
        private readonly string|null $isbn,
        private readonly int|null $offset,
        private readonly string|null $price,
        private readonly string|null $publisher,
        private readonly string|null $title,
    ) {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    protected function getRules(): array
    {
        return parent::getRules() + [
            'ageGroup' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'contributor' => 'nullable|string|max:255',
            'isbn' => [
                'nullable',
                'string',
                'regex:/^(\d{10}|\d{13})(;\d{10}|\d{13})*$/'
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
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = get_object_vars($this);

        $data['age-group'] = $data['ageGroup'] ?? null;
        unset($data['ageGroup']);

        return array_filter($data, fn($value) => !is_null($value));
    }
}
