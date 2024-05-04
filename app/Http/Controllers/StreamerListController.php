<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Streamer;
use App\Models\DailyRankVideo;

class StreamerListController extends Controller
{
    //daily_rank_video의 스트리머 조회후 api요청
    public static function storeStreamerData(): void
    {
        $drv = new DailyRankVideo;
        $streamerList = $drv->select('type','channel','channel_id')->distinct()->get();

        try{
            if(!empty($streamerList)){
                foreach($streamerList as $list){
                    if($list['type'] == 'youtube'){

                        self::getYoutubeChannel($list['channel_id']);

                    }else if($list['type'] == 'chzzk'){

                        self::getChzzkChannel($list['channel_id']);
                    }
                }
            }
        }catch(Exception $e){
            Log::debug($e->getMessage());
        }
    }

    //유튜브 스트리머데이터 수집
    private static function getYoutubeChannel($channelId): void
    {
        $strmr = new Streamer;
        $youtubeApiKey = env('YOUTUBE_API_KEY');
        //$regionCode = env('YOUTUBE_REGION');
        
        //part 
        $param['part'] = "snippet";
        //채널id
        $param['id'] = $channelId;
        //key
        $param['key'] = $youtubeApiKey;

        try {
            //youtubeAPI 영상정보 수집 호출
            $result = curlGet('https://www.googleapis.com/youtube/v3/channels',$param);

            //dd($result);

            if(!empty($result)){
                foreach ($result['items'] as $item) {
                    $strmrItem = [
                        'platform' => 'youtube',
                        'channel_name' => $item['snippet']['title'],
                        'channel_id' => $item['id'],
                        'channel_thumbnail' => isset($item['snippet']['thumbnails']['default']['url'])? $item['snippet']['thumbnails']['default']['url'] : "none",
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                    $strmr->updateOrCreate(['channel_id'=>$strmrItem['channel_id']], $strmrItem);
                }
            }else{
                //Log::info('getYoutubeVideo_조회실패');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }


    //치지직 스트리머데이터 수집
    private static function getChzzkChannel($channelId): void
    {   
        $strmr = new Streamer;

        try {
            //치지직 영상정보 수집 호출
            $result = curlGet('https://api.chzzk.naver.com/service/v1/channels/'.$channelId);

            //dd($result);

            if(!empty($result)){
                    $strmrItem = [
                        'platform' => 'chzzk',
                        'channel_name' => $result['content']['channelName'],
                        'channel_id' => $result['content']['channelId'],
                        'channel_thumbnail' => isset($result['content']['channelImageUrl'])? $result['content']['channelImageUrl'] : "none",
                        'created_at' => date('Y-m-d H:i:s')
                    ];
            
                    $strmr->updateOrCreate(['channel_id'=>$strmrItem['channel_id']], $strmrItem);
            }else{
                //Log::info('getChzzkVideo_조회실패');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }
}
