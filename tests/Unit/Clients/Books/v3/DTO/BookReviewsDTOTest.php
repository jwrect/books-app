<?php

namespace Tests\Unit\Clients\Books\v3\DTO;

use App\Clients\Books\v3\DTO\BookReviewsDTO;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BookReviewsDTOTest extends TestCase
{
    /** @test */
    public function it_creates_dto_with_valid_data()
    {
        $dto = new BookReviewsDTO(
            isbn: ['1234567890', '9781234567897'],
            title: 'Some Book',
            author: 'Steven King'
        );

        $queryArray = $dto->toQueryArray();

        $this->assertEquals('1234567890;9781234567897', $queryArray['isbn']);
        $this->assertEquals('Some Book', $queryArray['title']);
        $this->assertEquals('Steven King', $queryArray['author']);
    }

    /** @test */
    public function it_converts_isbn_array_to_semicolon_separated_string()
    {
        $dto = new BookReviewsDTO(isbn: ['1111111111', '2222222222']);

        $query = $dto->toQueryArray();
        $this->assertArrayHasKey('isbn', $query);
        $this->assertEquals('1111111111;2222222222', $query['isbn']);
    }

    /** @test */
    public function it_excludes_null_values_from_query_array()
    {
        $dto = new BookReviewsDTO();

        $query = $dto->toQueryArray();
        $this->assertArrayNotHasKey('isbn', $query);
        $this->assertArrayNotHasKey('title', $query);
        $this->assertArrayNotHasKey('author', $query);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
    }
}
