<?php

namespace App\Clients\Books\v3\DTO;

final class BestSellersByDateDTO extends BooksDTO
{
    /**
     * @param string $list
     * @param string $date
     * @param int|null $offset
     */
    public function __construct(
        private readonly string $list,
        private readonly string $date,
        private readonly int|null $offset
    ) {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    protected function getRules(): array
    {
        return parent::getRules() + [
            'list' => 'required|string|max:255',
            'date' => 'required|date|date_format:Y-m-d',
            'offset' => 'nullable|integer|min:0|multiple_of:20',
        ];
    }

    /**
     * @return array
     */
    public function toQueryArray(): array
    {
        $data = $this->toArray();

        unset($data['list']);
        unset($data['date']);

        return array_filter($data, fn($value) => !is_null($value));
    }

    /**
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}
