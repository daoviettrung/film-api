<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class FilmService
{
    public function importCate(){
        $response = Http::get('http://example.com');
    }
}