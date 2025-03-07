<?php

namespace App\Clients\Books\v3\DTO;

final class TopFiveBooksDTO extends BooksDTO
{
    /**
     * @param string|null $publishedDate
     */
    public function __construct(
        private readonly string|null $publishedDate
    ) {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    protected function getRules(): array
    {
        return parent::getRules() + [
            'publishedDate' => 'nullable|date|date_format:Y-m-d',
        ];
    }

    /**
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = get_object_vars($this);

        $data['published_date'] = $data['publishedDate'] ?? null;
        unset($data['publishedDate']);

        return array_filter($data, fn($value) => !is_null($value));
    }
}
