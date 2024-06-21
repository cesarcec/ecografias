<?php

namespace App\Http\Controllers;

class ApiResponse {

    public static function success($data = [], $message = 'Operation successful', $status = 200)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ], $status);
    }

    public static function error($message = 'Operation failed', $status = 400, $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ], $status);
    }
}