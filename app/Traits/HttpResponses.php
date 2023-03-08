<?php

namespace App\Traits;

trait HttpResponses{

    protected function success($data, $message = null, $code = 200){
        return response() -> json([
            'status' => 'Request byl úspěšný.',
            'message' => $message,
            'data' => $data
        ], $code);

    }

    protected function error($data, $message = null, $code){
        return response() -> json([
            'status' => 'Došlo k chybě...',
            'message' => $message,
            'data' => $data
        ], $code);

    }
}