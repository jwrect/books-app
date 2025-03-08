<?php

namespace App\Clients\Books\v3\DTO;

final class BestSellersDTO extends BooksDTO
{
    /**
     * @param string $list
     * @param string|null $bestsellersDate
     * @param string|null $publishedDate
     * @param int|null $offset
     */
    public function __construct(
        protected readonly string $list = '',
        protected readonly string|null $bestsellersDate = null,
        protected readonly string|null $publishedDate = null,
        protected readonly int|null $offset = null,
    ) {
        parent::__construct();
    }

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return parent::getRules() + [
            'list' => 'required|string|max:255',
            'bestsellersDate' => 'nullable|date|date_format:Y-m-d',
            'publishedDate' => 'nullable|date|date_format:Y-m-d',
            'offset' => 'nullable|integer|min:0|multiple_of:20',
        ];
    }

    /**
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = $this->getObjectVars();

        $data['bestsellers-date'] = $data['bestsellersDate'] ?? null;
        unset($data['bestsellersDate']);

        $data['published-date'] = $data['publishedDate'] ?? null;
        unset($data['publishedDate']);

        return array_filter($data, fn($value) => !is_null($value));
    }
}
