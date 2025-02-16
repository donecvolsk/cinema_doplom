<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/public/images/' . $filename); // путь к изображению

        if (!File::exists($path)) {
            abort(404, 'Изображение не найдено.');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
