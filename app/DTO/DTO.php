<?php

namespace App\DTO;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class DTO
{
    /**
     * @param array $data
     * @return static
     * @throws ValidationException
     */
    public static function create(array $data): static
    {
        $dto = new static(...$data);

        $dto->validate();

        return $dto;
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [];
    }

    /**
     * @throws ValidationException
     */
    protected function validate(): self
    {
        $validator = Validator::make($this->toArray(), $this->getRules());

        if ($validator->fails()) {
            Log::error('Validator failed', $validator->errors()->toArray());
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
        return $this;
    }
}
