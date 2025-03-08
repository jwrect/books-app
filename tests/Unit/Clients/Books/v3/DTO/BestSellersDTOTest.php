<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BestSellersDTO;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class BestSellersDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_with_valid_data()
    {
        $dto = new BestSellersDTO(
            list: 'hardcover-fiction',
            bestsellersDate: '2025-03-08',
            publishedDate: '2025-03-08',
            offset: 20
        );

        $this->assertEquals('hardcover-fiction', $dto->toQueryArray()['list']);
        $this->assertEquals('2025-03-08', $dto->toQueryArray()['bestsellers-date']);
        $this->assertEquals('2025-03-08', $dto->toQueryArray()['published-date']);
        $this->assertEquals(20, $dto->toQueryArray()['offset']);
    }

    /** @test */
    public function it_returns_correct_query_array()
    {
        $dto = new BestSellersDTO(
            list: 'hardcover-fiction',
            bestsellersDate: '2025-03-08',
            publishedDate: '2025-03-08',
            offset: 40
        );

        $query = $dto->toQueryArray();
        $this->assertArrayHasKey('list', $query);
        $this->assertArrayHasKey('bestsellers-date', $query);
        $this->assertArrayHasKey('published-date', $query);
        $this->assertArrayHasKey('offset', $query);
        $this->assertEquals('hardcover-fiction', $query['list']);
        $this->assertEquals('2025-03-08', $query['bestsellers-date']);
        $this->assertEquals('2025-03-08', $query['published-date']);
        $this->assertEquals(40, $query['offset']);
    }

    /** @test */
    public function it_excludes_null_values_from_query_array()
    {
        $dto = new BestSellersDTO(
            list: 'hardcover-fiction'
        );

        $query = $dto->toQueryArray();
        $this->assertArrayHasKey('list', $query);
        $this->assertArrayNotHasKey('bestsellers-date', $query);
        $this->assertArrayNotHasKey('published-date', $query);
        $this->assertArrayNotHasKey('offset', $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
