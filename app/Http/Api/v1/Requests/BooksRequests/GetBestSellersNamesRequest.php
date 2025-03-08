<?php

namespace App\Http\Api\v1\Requests\BooksRequests;

use App\Http\Api\BaseRequest;

class GetBestSellersNamesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function filtered(): array
    {
        return $this->camelCaseKeys($this->only([]));
    }
}
