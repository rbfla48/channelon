<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyRankVideo;

class HomeController extends Controller
{
    public function __construct() {

    }
    //
    public function index()
    {
        $drv = new DailyRankVideo;

        $data['youtubeData'] = $drv->select('*')
                                    ->where('type', '=', 'youtube')
                                    ->where('up_time','<=',date('Y-m-d',strtotime('-1 days')))
                                    ->orderby('up_time','desc')
                                    ->get();

        $data['chzzkData'] = $drv->select('*')
                                    ->where('type', '=', 'chzzk')
                                    ->where('up_time','<=',date('Y-m-d',strtotime('-1 days')))
                                    ->orderby('up_time','desc')
                                    ->get();

        return view('home',['data'=>$data]);
    }
}
