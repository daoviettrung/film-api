<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $film = DB::table('film')
        ->leftJoin('film_cate_detail', 'film.slug', '=', 'film_cate_detail.film')
        ->leftJoin('categories', 'film_cate_detail.cate', '=', 'categories.slug')
        ->where('categories.slug', 'hanh-dong')
        ->limit(3)
        ->get();
        return response()->json([
            'data' => $film
        ]);
    }
}
