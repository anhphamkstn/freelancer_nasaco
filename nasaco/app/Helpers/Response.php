<?php

namespace App\Helpers;

class Response
{

    public static function response($result, $statusCode = 200, $message = 'OK', $headers = [])
    {
        $responseBody = array (
            'code'    => $statusCode,
            'message' => $message,
            'result'  => $result
        );

        return response()->json($responseBody, $statusCode, $headers);
    }

    public static function responseWithPageCount($result, $statusCode = 200, $message = 'OK', $headers = [], $pageCount = 0)
    {
        $responseBody = array (
            'code'    => $statusCode,
            'message' => $message,
            'result'  => $result,
            'page_count' => $pageCount
        );

        return response()->json($responseBody, $statusCode, $headers);
    }

    public static function responseWithError($message, $statusCode, $headers = [])
    {
        return self::response([], $statusCode, $message, $headers);
    }

    public static function responseNotFound($message = 'Resource is not found', $headers = [])
    {
        return self::response([], 404, $message, $headers);
    }

    public static function responseMissingParameter($message = 'Missing parameter', $data = [], $headers = [])
    {
        return self::response($data, 429, $message, $headers);
    }
}

