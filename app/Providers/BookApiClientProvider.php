<?php

namespace App\Providers;

use App\Clients\Books\BooksApiInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class BookApiClientProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BooksApiInterface::class, function ($app) {
            $version = config('external-api.books.version');

            return match ($version) {
                'v3' => $app->make(BooksApiClientV3::class),
                default => throw new \RuntimeException("Unsupported API version: $version"),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $baseUrl = config('external-api.books.endpoint') + config('external-api.books.version');

        Http::macro('books-api', function () use ($baseUrl) {
            return Http::baseUrl($baseUrl);
        });
    }
}
