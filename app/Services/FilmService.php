<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
class FilmService
{
    public function importCate(){
        $response = Http::get('https://ophim1.com/the-loai');
        $data = $response->object();
        $dataInsert = [];
        foreach($data as $value){
            $dataInsert[] = ['name'=>$value->name, 'slug'=> $value->slug];
        }
        DB::table('categories')->insert($dataInsert);
    }

    public function importCountry(){
        $response = Http::get('https://ophim1.com/quoc-gia');
        $data = $response->object();
        $dataInsert = [];
        foreach($data as $value){
            $dataInsert[] = ['name'=>$value->name, 'slug'=> $value->slug];
        }
        DB::table('country')->insert($dataInsert);
    }

    public function importFilm(){
        for($i = 1; $i <= 300; $i++){
            $page = $i;
            $response = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page={$page}");
            $data = $response->object();
            foreach($data->items as $value){
                $responseDetail = Http::get("https://ophim1.com/phim/{$value->slug}");
                dd($responseDetail->object());

            }
        }
    }
}