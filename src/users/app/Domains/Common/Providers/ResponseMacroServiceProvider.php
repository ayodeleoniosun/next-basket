<?php

namespace App\Domains\Common\Providers;

use App\Domains\Common\Enums\StatusEnum;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function (string $message, $data = [], int $statusCode = 200) {
            return Response::json([
                'status' => StatusEnum::SUCCESS,
                'message' => $message ?? null,
                'data' => $data,
            ], $statusCode);
        });

        Response::macro('error', function (string $message, int $statusCode = 400) {
            return Response::json([
                'status' => StatusEnum::ERROR,
                'message' => $message,
            ], $statusCode);
        });
    }
}
