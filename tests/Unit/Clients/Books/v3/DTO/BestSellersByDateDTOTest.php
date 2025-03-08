<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BestSellersByDateDTO;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BestSellersByDateDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_with_valid_data()
    {
        $dto = new BestSellersByDateDTO(
            list: 'hardcover-fiction',
            date: '2025-03-08',
            offset: 20
        );

        $this->assertEquals('hardcover-fiction', $dto->getList());
        $this->assertEquals('2025-03-08', $dto->getDate());
        $this->assertEquals(20, $dto->toQueryArray()['offset']);
    }

    /** @test */
    public function it_returns_correct_query_array()
    {
        $dto = new BestSellersByDateDTO(
            list: 'hardcover-fiction',
            date: '2025-03-08',
            offset: 40
        );

        $query = $dto->toQueryArray();
        $this->assertArrayHasKey('offset', $query);
        $this->assertEquals(40, $query['offset']);
    }

    /** @test */
    public function it_excludes_null_values_from_query_array()
    {
        $dto = new BestSellersByDateDTO(
            list: 'hardcover-fiction',
            date: '2025-03-08'
        );

        $query = $dto->toQueryArray();
        $this->assertArrayNotHasKey('offset', $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
