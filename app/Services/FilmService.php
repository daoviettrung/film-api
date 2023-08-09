<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class FilmService
{
    public function importCate(){
        var_dump('dsdds');die();
        $response = Http::get('http://example.com');
    }
}