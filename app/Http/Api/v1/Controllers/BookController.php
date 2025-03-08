<?php

namespace App\Http\Api\v1\Controllers;

use App\Http\Api\v1\Requests\BooksRequests\GetBestSellersByDateRequest;
use App\Http\Api\v1\Requests\BooksRequests\GetBestSellersHistory;
use App\Http\Api\v1\Requests\BooksRequests\GetBestSellersNamesRequest;
use App\Http\Api\v1\Requests\BooksRequests\GetBestSellersRequest;
use App\Http\Api\v1\Requests\BooksRequests\GetBookReviewsRequest;
use App\Http\Api\v1\Requests\BooksRequests\GetBooksFullOverviewRequest;
use App\Http\Api\v1\Requests\BooksRequests\GetTopFiveBooksRequest;
use App\Services\BooksService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * @var BooksService
     */
    private BooksService $booksService;

    /**
     * @param BooksService $booksService
     */
    public function __construct(BooksService $booksService)
    {
        $this->booksService = $booksService;
    }

    /**
     * @param GetBestSellersRequest $request
     * @return JsonResponse
     */
    public function getBestSellers(GetBestSellersRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellers($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetBestSellersByDateRequest $request
     * @return JsonResponse
     */
    public function getBestSellersByDate(GetBestSellersByDateRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellerByDate($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetBestSellersHistory $request
     * @return JsonResponse
     */
    public function getBestSellersHistory(GetBestSellersHistory $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellersHistory($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetBooksFullOverviewRequest $request
     * @return JsonResponse
     */
    public function getBooksFullOverview(GetBooksFullOverviewRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBooksFullOverview($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetBestSellersNamesRequest $request
     * @return JsonResponse
     */
    public function getBestSellersNames(GetBestSellersNamesRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellersNames($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetTopFiveBooksRequest $request
     * @return JsonResponse
     */
    public function getTopFiveBooks(GetTopFiveBooksRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getTopFiveBooks($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param GetBookReviewsRequest $request
     * @return JsonResponse
     */
    public function getBookReviews(GetBookReviewsRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBookReviews($data);

            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
