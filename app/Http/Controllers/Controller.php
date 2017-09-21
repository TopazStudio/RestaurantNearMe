<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return an error response
     *
     * @param string $info
     * @param string $error
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($error = '',$info = '',$status = 400){
        return response()->json([
            'message' => 'ERROR',
            'error' => $error,
            'info' => $info
        ],$status);
    }

    /**
     * Return an success response with info.
     *
     * @param string $info
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($info = '',$status = 200){
        return response()->json([
            'message' => 'OK',
            'info' => $info
        ],$status);
    }

    /**
     * Helper method used to retrieve json responses when in development
     * or views when in production
     *
     * @param string $response
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function response($response = '',$view = ''){
        if (env('APP_ENV') == 'development'){
            return response()->json($response);
        }else{
            return view($view)->with($response);
        }
    }
}
