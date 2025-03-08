<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BestSellersHistoryDTO;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BestSellersHistoryDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_with_valid_data()
    {
        $dto = new BestSellersHistoryDTO(
            ageGroup: 'Adult',
            author: 'Steven King',
            contributor: 'Jane Smith',
            isbn: ['1234567890', '9781234567897'],
            offset: 40,
            price: '9.99',
            publisher: 'Some publisher',
            title: 'Some Book'
        );

        $this->assertEquals('Adult', $dto->toQueryArray()['age-group']);
        $this->assertEquals('Steven King', $dto->toQueryArray()['author']);
        $this->assertEquals('Jane Smith', $dto->toQueryArray()['contributor']);
        $this->assertEquals('1234567890;9781234567897', $dto->toQueryArray()['isbn']);
        $this->assertEquals(40, $dto->toQueryArray()['offset']);
        $this->assertEquals('9.99', $dto->toQueryArray()['price']);
        $this->assertEquals('Some publisher', $dto->toQueryArray()['publisher']);
        $this->assertEquals('Some Book', $dto->toQueryArray()['title']);
    }

    /** @test */
    public function it_converts_isbn_array_to_semicolon_separated_string()
    {
        $dto = new BestSellersHistoryDTO(isbn: ['1111111111', '2222222222']);

        $query = $dto->toQueryArray();
        $this->assertArrayHasKey('isbn', $query);
        $this->assertEquals('1111111111;2222222222', $query['isbn']);
    }

    /** @test */
    public function it_excludes_null_values_from_query_array()
    {
        $dto = new BestSellersHistoryDTO();

        $query = $dto->toQueryArray();
        $this->assertArrayNotHasKey('age-group', $query);
        $this->assertArrayNotHasKey('author', $query);
        $this->assertArrayNotHasKey('isbn', $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
