<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BooksFullOverviewDTO;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BooksFullOverviewDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_with_valid_data()
    {
        $dto = new BooksFullOverviewDTO(publishedDate: '2025-03-08');

        $queryArray = $dto->toQueryArray();

        $this->assertEquals('2025-03-08', $queryArray['published_date']);
    }

    /** @test */
    public function it_excludes_null_values_from_query_array()
    {
        $dto = new BooksFullOverviewDTO();

        $query = $dto->toQueryArray();
        $this->assertArrayNotHasKey('published_date', $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
