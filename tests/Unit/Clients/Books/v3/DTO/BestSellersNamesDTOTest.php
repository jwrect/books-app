<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BestSellersNamesDTO;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BestSellersNamesDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_instance()
    {
        $dto = new BestSellersNamesDTO();

        $this->assertInstanceOf(BestSellersNamesDTO::class, $dto);
    }

    /** @test */
    public function it_returns_empty_query_array()
    {
        $dto = new BestSellersNamesDTO();

        $query = $dto->toQueryArray();
        $this->assertIsArray($query);
        $this->assertEquals(['api-key' => 'some-key'], $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
