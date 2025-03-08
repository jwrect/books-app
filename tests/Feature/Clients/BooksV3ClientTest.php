<?php

namespace Tests\Feature\Clients;

use App\Clients\Books\v3\BooksV3Client;
use App\Exceptions\Http\InvalidParametersException;
use App\Exceptions\Http\RequestException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BooksV3ClientTest extends TestCase
{
    use WithFaker;

    private BooksV3Client $client;

    /** @test */
    public function it_fetches_best_sellers_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response']),
        ]);

        $response = $this->client->fetchBestSellers(['list' => 'hardcover-fiction']);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_throws_request_exception_on_failure()
    {
        Http::fake([
            '*' => Http::response([], 500),
        ]);

        $this->expectException(RequestException::class);

        $this->client->fetchBestSellers(['list' => 'hardcover-fiction']);
    }

    /** @test */
    public function it_throws_invalid_parameters_exception_on_missing_data()
    {
        Http::fake();

        $this->expectException(InvalidParametersException::class);

        $this->client->fetchBestSellers([]);
    }

    /** @test */
    public function it_fetches_best_sellers_by_date_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response']),
        ]);

        $response = $this->client->fetchBestSellersByDate(['date' => '2024-03-08', 'list' => 'hardcover-fiction']);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_fetches_best_sellers_history_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response']),
        ]);

        $response = $this->client->fetchBestSellersHistory(['author' => 'Steven King']);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_fetches_books_full_overview_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response']),
        ]);

        $response = $this->client->fetchBooksFullOverview([]);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_fetches_best_sellers_names_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response']),
        ]);

        $response = $this->client->fetchBestSellersNames();

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_fetches_top_five_books_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response'], 200),
        ]);

        $response = $this->client->fetchTopFiveBooks(['publishedDate' => '2025-03-08']);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    /** @test */
    public function it_fetches_book_reviews_successfully()
    {
        Http::fake([
            '*' => Http::response(['data' => 'mocked_response'], 200),
        ]);

        $response = $this->client->fetchBookReviews(['title' => 'Example Book']);

        $this->assertIsArray($response);
        $this->assertEquals('mocked_response', $response['data']);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('external-api.books.api_key', 'some-key');
        $this->client = new BooksV3Client();
    }
}
