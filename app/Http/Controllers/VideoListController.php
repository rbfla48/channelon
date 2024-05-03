<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyRankVideo;
use App\Jobs\FetchAfricaVod;

class VideoListController extends Controller
{

    //유튜브 동영상데이터 수집
    public static function getYoutubeVideo(): void
    {
        $drv = new DailyRankVideo;
        $youtubeApiKey = env('YOUTUBE_API_KEY');
        $regionCode = env('YOUTUBE_REGION');
        
        //part 
        $param['part'] = "snippet";
        //조회갯수(MAX 50)
        $param['maxResults'] = 50;
        //조회기준
        $param['chart'] = "mostPopular";//인기동영상
        //$param['id'] = "";//동영상ID
        //$param['myRating'] = "";//사용자기준
        //$param['videoCategoryId'] = "";//카테고리code기준
        //국가코드
        $param['regionCode'] = $regionCode;
        //key
        $param['key'] = $youtubeApiKey;

        try {
            //youtubeAPI 영상정보 수집 호출
            $result = curlGet('https://www.googleapis.com/youtube/v3/videos',$param);

            //dd($result);

            if(!empty($result)){
                foreach ($result['items'] as $item) {
                    $drvItem = [
                        'type' => 'youtube',
                        'channel' => $item['snippet']['channelTitle'],
                        'channel_id' => $item['snippet']['channelId'],
                        'up_time' => date('Y-m-d H:i:s', strtotime($item['snippet']['publishedAt'])),
                        'thumbnail' => isset($item['snippet']['thumbnails']['maxres']['url']) ? $item['snippet']['thumbnails']['maxres']['url'] : 'none',
                        'category' => $item['snippet']['categoryId'],
                        'title' => $item['snippet']['title'],
                        'video_id' => $item['id'],
                        'video_link' => 'https://www.youtube.com/watch?v='.$item['id'],
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                    $drv->updateOrCreate(['video_id'=>$drvItem['video_id']], $drvItem);
                }
            }else{
                //Log::info('getYoutubeVideo_조회실패');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
        
    }


    //치지직 동영상데이터 수집
    public static function getChzzkVideo(): void
    {   
        $drv = new DailyRankVideo;
        //조회갯수(MAX 50)
        $param['size'] = 50;

        try {
            //치지직 영상정보 수집 호출
            $result = curlGet('https://api.chzzk.naver.com/service/v1/videos',$param);

            if(!empty($result)){
                foreach ($result['content']['data'] as $item) {
                    $drvItem = [
                        'type' => 'chzzk',
                        'channel' => $item['channel']['channelName'],
                        'channel_id' => $item['channel']['channelId'],
                        'up_time' => date('Y-m-d H:i:s', strtotime($item['publishDate'])),
                        'thumbnail' => isset($item['thumbnailImageUrl']) ? $item['thumbnailImageUrl'] : 'none',
                        'category' => isset($item['categoryType']) ? $item['categoryType'] : 'none',
                        'title' => $item['videoTitle'],
                        'video_id' => $item['videoNo'],
                        'video_link' => 'https://chzzk.naver.com/video/'.$item['videoNo'],
                        'created_at' => date('Y-m-d H:i:s')
                    ];
            
                    $drv->updateOrCreate(['video_id'=>$drvItem['video_id']], $drvItem);
                }

            }else{
                //Log::info('getChzzkVideo_조회실패');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    //아프리카TV VOD 크롤링 수집
    public static function getAfricaVodList(): void
    {
        $url = 'https://vod.afreecatv.com/'; // URL, where you want to fetch the content
   
        FetchAfricaVod::dispatch((string)$url);
    }

}
