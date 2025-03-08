<?php

namespace App\Http\Api\v1\Controllers;

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

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param GetBestSellersRequest $request
     * @return JsonResponse
     */
    public function getBestSellersByDate(GetBestSellersRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellerByDate($data);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param GetBestSellersRequest $request
     * @return JsonResponse
     */
    public function getBestSellersHistory(GetBestSellersRequest $request): JsonResponse
    {
        try {
            $data = $request->filtered();
            $response = $this->booksService->getBestSellersHistory($data);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
