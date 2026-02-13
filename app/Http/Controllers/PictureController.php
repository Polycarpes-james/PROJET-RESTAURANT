<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;

class PictureController extends Controller
{
    public function show (Request $request, string $path){
        // dd($path);
        SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());
        
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory($request),
            'source' => Storage::disk('public')->getDriver(),
            'cache' => Storage::disk('local')->getDriver(),
            'cach_path_prefix' => '.cache',
            'base_url' => 'images'
        ]);

        return $server->getImageResponse($path, $request->all());
    }
}
