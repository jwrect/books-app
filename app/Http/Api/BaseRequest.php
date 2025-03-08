<?php

namespace App\Http\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class BaseRequest extends FormRequest
{
    abstract public function filtered(): array;

    protected function camelCaseKeys(array $data): array
    {
        return collect($data)->mapWithKeys(function ($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray();
    }
}
