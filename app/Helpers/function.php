<?php

use App\Enums\ApiResponseEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;

if (! function_exists('success')) {
    /**
     * @param $message string
     * @param $data array
     * @param $code int
     */
    function success(string $message = '', array $data = [], int $code = 200): JsonResponse
    {
        $response = [
            'code' => $code,
            'status' => ApiResponseEnum::statusSuccess()->value,
            'message' => $message,
            'result' => [
                'data' => $data,
            ],
        ];

        return response()->json($response, 200);
    }

}

if (! function_exists('failed')) {
    /**
     * @param $message string
     * @param $data array | MessageBag
     * @param $code int
     */
    function failed(string $message = '', array|MessageBag $data = [], int $code = 400): JsonResponse
    {
        $response = [
            'code' => $code,
            'status' => ApiResponseEnum::statusFailed()->value,
            'message' => $message,
            'result' => [
                'data' => $data,
            ],
        ];

        return response()->json($response, 400);
    }
}

if (! function_exists('exceptionResponse')) {

    function exceptionResponse(Exception $exception): JsonResponse
    {
        Log::info($exception->getMessage());

        return response()->json([
            'status' => ApiResponseEnum::statusFailed()->value,
            'message' => 'An unexpected error was encountered. Please contact the Admin.',
            'result' => [
                'data' => null,
            ],
            'error' => $exception->getMessage(),
        ], 500);
    }
}
if (! function_exists('modify_phone')) {
    /**
     * @param  string  $phoneNumber
     */
    function modify_phone($phoneNumber): string
    {
        $replacement = 'xxxxx';

        return substr_replace($phoneNumber, $replacement, 3, 5);
    }
}
if (! function_exists('send_post_request')) {
    /**
     * @param $url string
     * @param $data array
     * @param $headers array
     */
    function send_post_request(string $url, array $data, array $headers): array
    {
        $response = Http::withHeaders($headers)->post($url, $data);

        return $response->json();
    }
}
