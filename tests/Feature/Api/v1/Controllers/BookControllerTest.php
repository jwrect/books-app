<?php

namespace Tests\Feature\Api\v1\Controllers;

use App\Services\BooksService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    private BooksService $booksServiceMock;

    /** @test */
    public function it_returns_best_sellers_by_date_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getBestSellerByDate')
            ->once()
            ->andReturn(['book1', 'book2']);

        $response = $this->getJson('/api/v1/books/best-sellers/2025-03-08/hardcover-fiction');

        $response->assertStatus(200)
            ->assertJson(['book1', 'book2']);
    }

    /** @test */
    public function it_returns_best_sellers_history_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getBestSellersHistory')
            ->once()
            ->andReturn(['history' => ['Book 1', 'Book 2']]);

        $response = $this->getJson('/api/v1/books/best-sellers/history?author=Steven%20King');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['history' => ['Book 1', 'Book 2']]
            ]);
    }

    /** @test */
    public function it_returns_books_full_overview_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getBooksFullOverview')
            ->once()
            ->andReturn(['overview' => ['Book 1', 'Book 2']]);

        $response = $this->getJson('/api/v1/books/full-overview?published_date=2025-03-08');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['overview' => ['Book 1', 'Book 2']]
            ]);
    }

    /** @test */
    public function it_returns_best_sellers_names_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getBestSellersNames')
            ->once()
            ->andReturn(['names' => ['Book 1', 'Book 2']]);

        $response = $this->getJson('/api/v1/books/best-sellers/names');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['names' => ['Book 1', 'Book 2']]
            ]);
    }

    /** @test */
    public function it_returns_top_five_books_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getTopFiveBooks')
            ->once()
            ->andReturn(['books' => ['Book 1', 'Book 2', 'Book 3']]);

        $response = $this->getJson('/api/v1/books/top-five?published_date=2025-03-08');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['books' => ['Book 1', 'Book 2', 'Book 3']]
            ]);
    }

    /** @test */
    public function it_returns_book_reviews_successfully()
    {
        $this->booksServiceMock
            ->shouldReceive('getBookReviews')
            ->once()
            ->andReturn(['reviews' => ['Great book!', 'Must-read']]);

        $response = $this->getJson('/api/v1/books/reviews?isbn[]=1234567890');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['reviews' => ['Great book!', 'Must-read']]
            ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->booksServiceMock = Mockery::mock(BooksService::class);
        $this->app->instance(BooksService::class, $this->booksServiceMock);
    }
}
