<?php

namespace Tests\Feature\Services;

use App\Clients\Books\BooksClientInterface;
use App\Helpers\CacheHelper;
use App\Services\BooksService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class BooksServiceTest extends TestCase
{
    private BooksService $service;
    private BooksClientInterface $clientMock;

    /** @test */
    public function it_fetches_best_sellers_and_caches_result()
    {
        $data = ['list' => 'hardcover-fiction'];
        $expectedResponse = ['books' => ['Book 1', 'Book 2']];

        $this->clientMock
            ->shouldReceive('fetchBestSellers')
            ->with($data)
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBestSellers($data);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_best_seller_by_date_and_caches_result()
    {
        $data = ['date' => '2025-03-08', 'list' => 'hardcover-fiction'];
        $expectedResponse = ['books' => ['Book 1', 'Book 2']];

        $this->clientMock
            ->shouldReceive('fetchBestSellersByDate')
            ->with($data)
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBestSellerByDate($data);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_best_sellers_history_and_caches_result()
    {
        Cache::flush();
        $data = ['author' => 'Steven King'];
        $expectedResponse = ['history' => ['Book 1', 'Book 2']];

        $this->clientMock
            ->shouldReceive('fetchBestSellersHistory')
            ->with($data)
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBestSellersHistory($data);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_books_full_overview_and_caches_result()
    {
        $expectedResponse = ['overview' => ['Book 1', 'Book 2']];

        $this->clientMock
            ->shouldReceive('fetchBooksFullOverview')
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBooksFullOverview([]);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_best_sellers_names_and_caches_result()
    {
        $expectedResponse = ['names' => ['Book 1', 'Book 2']];

        $this->clientMock
            ->shouldReceive('fetchBestSellersNames')
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBestSellersNames([]);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_top_five_books_and_caches_result()
    {
        $data = ['list' => 'hardcover-fiction'];
        $expectedResponse = ['books' => ['Book 1', 'Book 2', 'Book 3']];

        $this->clientMock
            ->shouldReceive('fetchTopFiveBooks')
            ->with($data)
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getTopFiveBooks($data);

        $this->assertEquals($expectedResponse, $result);
    }

    /** @test */
    public function it_fetches_book_reviews_and_caches_result()
    {
        $data = ['isbn' => '1234567890'];
        $expectedResponse = ['reviews' => ['Great book!', 'Must-read']];

        $this->clientMock
            ->shouldReceive('fetchBookReviews')
            ->with($data)
            ->andReturn($expectedResponse);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($expectedResponse);

        $result = $this->service->getBookReviews($data);

        $this->assertEquals($expectedResponse, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientMock = Mockery::mock(BooksClientInterface::class);
        $this->app->instance(BooksClientInterface::class, $this->clientMock);
        $this->service = new BooksService($this->clientMock);
    }
}
