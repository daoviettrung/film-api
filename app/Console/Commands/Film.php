<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Film extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:film';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for($i = 41; $i <= 60; $i++){
            $page = $i;
            $response = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page={$page}");
            $data = $response->object();
            foreach($data->items as $value){
                $responseDetail = Http::get("https://ophim1.com/phim/{$value->slug}");
                $dataFilm = $responseDetail->object()->movie;
                $cate = [];
                $countryArr = [];
                $dataInsertFiml = [];
                foreach($dataFilm->category as $key => $value){
                    $cate[$key]['cate'] = $value->slug;
                    $cate[$key]['film'] = $dataFilm->slug;
                }
                foreach($dataFilm->country as $key => $value){
                    $countryArr[$key]['country'] = $value->slug;
                    $countryArr[$key]['film'] = $dataFilm->slug;
                }
                $films = $responseDetail->object()->episodes[0]->server_data;
                foreach($films as $value){
                    $dataInsertFiml[] = [
                        'name' => $value->name,
                        'slug' => $value->slug,
                        'filename' => $value->filename,
                        'link_embed' => $value->link_embed,
                        'link_m3u8' => $value->link_m3u8,
                        'film' => $dataFilm->slug,
                    ]; 
                }

                $dataInsert = [
                    'name' => $dataFilm->name,
                    'slug' => $dataFilm->slug,
                    'origin_name' => $dataFilm->origin_name,
                    'content' => $dataFilm->content,
                    'type' => $dataFilm->type,
                    'status' => $dataFilm->status,
                    'thumb_url' => $dataFilm->thumb_url,
                    'poster_url' => $dataFilm->poster_url,
                    'is_copyright' => $dataFilm->is_copyright,
                    'trailer_url' => $dataFilm->trailer_url,
                    'time' => $dataFilm->time,
                    'episode_total' => $dataFilm->episode_total,
                    'quality' => $dataFilm->quality,
                    'lang' => $dataFilm->lang,
                    'notify' => $dataFilm->notify,
                    'year' => $dataFilm->year,
                    'view' => $dataFilm->view,
                    'actor' => implode(",",$dataFilm->actor),
                    'director' => implode(",",$dataFilm->director),
                ];

                DB::table('film')->insert($dataInsert);
                DB::table('film_cate_detail')->insert($cate);
                DB::table('film_country_detail')->insert($countryArr);
                DB::table('episodes')->insert($dataInsertFiml);
            }
        }
        echo "Done";die();
    }
}
