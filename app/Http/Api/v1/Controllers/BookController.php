<?php

namespace App\Http\Api\v1\Controllers;

use App\Clients\Books\BooksApiInterface;

class BookController extends Controller
{
    private BooksApiInterface $api;

    public function __construct(BooksApiInterface $api)
    {
        $this->api = $api;
    }

    public function getBestSellers()
    {
        try {
            $response = $this->api->getBestSellers();
        } catch (\Exception $e) {

        }

        return response()->json($response, 200);
    }

    public function getBestSellersByDate()
    {
        $response = $this->api->getBestSellersByDate();

        return response()->json($response, 200);
    }

    public function getBestSellersHistory()
    {
        $response = $this->api->getBestSellersHistory();
    }

    public function getBooksFullOverview()
    {
        $response = $this->api->getBooksFullOverview();
    }

    public function getBestSellersNames()
    {
        $response = $this->api->getBestSellersNames();
    }

    public function getTopFiveBooks()
    {
        $response = $this->api->getTopFiveBooks();
    }

    public function getBookReviews()
    {
        $this->api->getBookReviews();
    }
}
