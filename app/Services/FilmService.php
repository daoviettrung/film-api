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
}