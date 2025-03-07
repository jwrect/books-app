<?php

namespace App\Clients\Books;

interface BooksApiInterface
{
    public function getBestSellers();

    public function getBestSellersByDate();

    public function getBestSellersHistory();

    public function getBooksFullOverview();

    public function getBestSellersNames();

    public function getTopFiveBooks();

    public function getBookReviews();
}
