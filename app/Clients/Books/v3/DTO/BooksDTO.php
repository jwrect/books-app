<?php

namespace App\Clients\Books\v3\DTO;

use App\DTO\DTO;

abstract class BooksDTO extends DTO
{
    /**
     * @var string
     */
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('external-api.books.api_key');
    }

    /**
     * @return string[]
     */
    protected function getRules(): array
    {
        return [
            'apiKey' => 'required|string'
        ];
    }

    /**
     * @return array|string[]
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function getObjectVars(): array
    {
        $data = get_object_vars($this);
        $data['api-key'] = $this->apiKey;
        unset($data['apiKey']);
        return $data;
    }

    /**
     * @return array
     */
    public function toQueryArray(): array
    {
        return array_filter($this->getObjectVars(), fn($value) => !is_null($value));
    }
}
