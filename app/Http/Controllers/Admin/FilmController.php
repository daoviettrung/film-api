<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use App\Services\FilmService;

class FilmController extends Controller
{
    /**
     * Import data cate
     */
    public function importCate(Request $request)
    {
        $filmService = new FilmService();
        $filmService->importCate();
    }
}
