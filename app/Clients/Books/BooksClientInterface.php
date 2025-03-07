<?php

namespace App\Clients\Books;

interface BooksClientInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function fetchBestSellers(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function fetchBestSellersByDate(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function fetchBestSellersHistory(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function fetchBooksFullOverview(array $data): array;

    /**
     * @return array
     */
    public function fetchBestSellersNames(): array;

    /**
     * @param array $data
     * @return array
     */
    public function fetchTopFiveBooks(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function fetchBookReviews(array $data): array;
}
