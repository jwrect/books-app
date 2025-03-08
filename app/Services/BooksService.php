<?php

namespace App\Services;

use App\Clients\Books\BooksClientInterface;
use App\Exceptions\ParseJsonException;
use App\Helpers\CacheHelper;
use Illuminate\Support\Facades\Cache;

class BooksService
{
    private BooksClientInterface $client;
    private int $ttl;

    public function __construct(BooksClientInterface $client)
    {
        $this->client = $client;
        $this->ttl = config('external-api.books.ttl');
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBestSellers(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('best_sellers_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBestSellers($data);
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBestSellerByDate(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('best_seller_by_date_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBestSellersByDate($data);
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBestSellersHistory(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('best_sellers_history_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBestSellersHistory($data);
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBooksFullOverview(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('books_full_overview_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBooksFullOverview($data);
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBestSellersNames(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('best_sellers_names_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBestSellersNames();
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getTopFiveBooks(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('top_five_books_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchTopFiveBooks($data);
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws ParseJsonException
     */
    public function getBookReviews(array $data): array
    {
        $cacheKey = CacheHelper::generateCacheKey('book_reviews_', $data);
        return Cache::remember($cacheKey, $this->ttl, function () use ($data) {
            return $this->client->fetchBookReviews($data);
        });
    }
}
