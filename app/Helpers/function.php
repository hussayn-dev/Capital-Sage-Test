<?php

use  Illuminate\Http\JsonResponse;
use  App\Enums\ApiResponseEnum;
use Illuminate\Support\Facades\Http;
use  Illuminate\Support\MessageBag;
use  Illuminate\Support\Facades\Log;



if (!function_exists('success')) {
    /**
     * @param $message string
     * @param $data array
     * @param $code int
     * @return JsonResponse
     */
       function success(string $message = '', array $data = [], int $code = 200): JsonResponse
    {
            $response = [
                'code' => $code,
                'status' => ApiResponseEnum::statusSuccess()->value,
                'message' => $message,
                'result' => [
                    'data' => $data
                ]
            ];

            return response()->json($response, 200);
        }

}


if (!function_exists('failed')) {
    /**
     * @param $message string
     * @param $data array | MessageBag
     * @param $code int
     * @return JsonResponse
     */
    function failed(string $message = '', array | MessageBag $data = [], int $code = 400): JsonResponse
    {
        $response = [
            'code' => $code ?? 400,
            'status' => ApiResponseEnum::statusFailed()->value,
            'message' => $message,
            'result' => [
                'data' => $data
            ]
        ];

        return response()->json($response, 400);
    }
}


if (!function_exists('exceptionResponse')) {
    /**
     * @param Exception $exception
     * @return JsonResponse
     */
    function exceptionResponse(Exception $exception): JsonResponse
    {
        Log::info($exception->getMessage());
        return response()->json([
            'status' => ApiResponseEnum::statusFailed()->value,
            'message' => 'An unexpected error was encountered. Please contact the Admin.',
            'result' => [
                'data' => null
            ],
            'error' => $exception->getMessage(),
        ], 500);
    }
}
if (!function_exists('modify_phone')) {
    /**
     * @param string $phoneNumber
     * @return string
     */
    function modify_phone($phoneNumber) : string
    {
        $replacement = 'xxxxx';
       return substr_replace($phoneNumber, $replacement, 3, 5);
    }
}
if (!function_exists('send_post_request')) {
    /**
     * @param $url string
     * @param $data array
     * @param $headers array
     * @return array
     */
    function send_post_request(string $url, array $data, array $headers): array
    {
        $response = Http::withHeaders($headers)->post($url, $data);
        return $response->json();
    }
}
