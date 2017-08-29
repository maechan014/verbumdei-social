<?php
namespace Illuminate\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use ErrorException;

$path = storage_path() . "\json\address.json"; // ie: /var/www/laravel/app/storage/json/filename.json

if (!Filesystem::exists($path)) {
    throw new Exception("Invalid File");
}

$file = new Filesystem;
return [

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables
    |--------------------------------------------------------------------------
    |
    | This is a set of variables that are made specific to this application
    | that are better placed here rather than in .env file.
    | Use config('your_key') to get the values.
    |
    */
    'regions' => $file->get($path),
];