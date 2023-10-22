<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function returnResponse($success = true, $result = null, $message){
        $response = [
            'success' => $success,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
