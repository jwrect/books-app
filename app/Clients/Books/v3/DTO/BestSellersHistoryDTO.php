<?php

namespace App\Clients\Books\v3\DTO;

final class BestSellersHistoryDTO extends BooksDTO
{
    /**
     * @param string|null $ageGroup
     * @param string|null $author
     * @param string|null $contributor
     * @param array|null $isbn
     * @param int|null $offset
     * @param string|null $price
     * @param string|null $publisher
     * @param string|null $title
     */
    public function __construct(
        protected readonly string|null $ageGroup = null,
        protected readonly string|null $author  = null,
        protected readonly string|null $contributor = null,
        protected readonly array|null $isbn = null,
        protected readonly int|null $offset = null,
        protected readonly string|null $price  = null,
        protected readonly string|null $publisher = null,
        protected readonly string|null $title = null,
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
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = $this->getObjectVars();

        if (isset($data['isbn']) && is_array($data['isbn'])) {
            $data['isbn'] = implode(';', $data['isbn']);
        }

        $data['age-group'] = $data['ageGroup'] ?? null;
        unset($data['ageGroup']);

        return array_filter($data, fn($value) => !is_null($value));
    }
}
