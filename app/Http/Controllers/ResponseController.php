<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    //
    public function response(Request $request): Response
    {
        return response("hello response");
    }

    public function header(Request $request): Response
    {
        $body = [
            'name' => 'programmer zaman now',
            'age' => '30',
        ];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'programmer zaman now',
                'App' => '20',
            ]);
    }
    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', ['name' => 'programmer zaman now']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'name' => 'programmer zaman now',
            'age' => '30',
        ];
        return response()
            ->json($body);
    }
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(public_path('app/public/pictures/Batu.png'));
    }
    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(public_path('app/public/pictures/Batu.png'));
    }
}
