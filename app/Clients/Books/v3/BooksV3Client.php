<?php

namespace App\Clients\Books\v3;

use App\Clients\Books\BooksClientInterface;
use App\Clients\Books\v3\DTO\BestSellersByDateDTO;
use App\Clients\Books\v3\DTO\BestSellersDTO;
use App\Clients\Books\v3\DTO\BestSellersHistoryDTO;
use App\Clients\Books\v3\DTO\BestSellersNamesDTO;
use App\Clients\Books\v3\DTO\BookReviewsDTO;
use App\Clients\Books\v3\DTO\BooksFullOverviewDTO;
use App\Clients\Books\v3\DTO\TopFiveBooksDTO;
use App\Exceptions\Http\InvalidParametersException;
use App\Exceptions\Http\RequestException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

final class BooksV3Client implements BooksClientInterface
{
    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBestSellers(array $data): array
    {
        try {
            $query = BestSellersDTO::create($data)?->toQueryArray();

            $response = Http::books()->get('/lists.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books best sellers.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books best sellers.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException('Invalid parameters provided to fetch books best sellers.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBestSellersByDate(array $data): array
    {
        try {
            $dto = BestSellersByDateDTO::create($data);
            $date = $dto->getDate();
            $list = $dto->getList();
            $query = $dto->toQueryArray();

            $response = Http::books()->get("/lists/{$date}/{$list}.json", $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books best sellers by date.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books best sellers by date.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch books best sellers by date.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBestSellersHistory(array $data): array
    {
        try {
            $query = BestSellersHistoryDTO::create($data)?->toQueryArray();
            $response = Http::books()->get('/lists/best-sellers/history.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books best sellers history.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books best sellers history.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch books best sellers history.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBooksFullOverview(array $data): array
    {
        try {
            $query = BooksFullOverviewDTO::create($data)?->toQueryArray();

            $response = Http::books()->get('/lists/full-overview.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books full overview.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books full overview.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch books full overview.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBestSellersNames(): array
    {
        try {
            $query = BestSellersNamesDTO::create([])?->toQueryArray();

            $response = Http::books()->get('/lists/names.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books best sellers names.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books best sellers names.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch books best sellers names.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchTopFiveBooks(array $data): array
    {
        try {
            $query = TopFiveBooksDTO::create($data)?->toQueryArray();

            $response = Http::books()->get('/lists/overview.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch top five books.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch top five books.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch top five books.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidParametersException
     * @throws RequestException
     */
    public function fetchBookReviews(array $data): array
    {
        try {
            $query = BookReviewsDTO::create($data)?->toQueryArray();
            $response = Http::books()->get('/reviews.json', $query);

            if ($response->failed()) {
                throw new RequestException('Failed to fetch books reviews.', [
                    'status' => $response->getStatusCode(),
                    'data' => $response->json(),
                ]);
            }

            return $response->json();
        } catch (ClientException $e) {
            throw new RequestException('Failed to fetch books reviews.', [
                'exception' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            throw new InvalidParametersException(
                'Invalid parameters provided to fetch books reviews.', [
                'exception' => $e->getMessage(),
                'parameters' => $e->errors(),
            ]);
        }
    }
}
