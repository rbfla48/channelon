<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveListController extends Controller
{
    //
    public function getLiveList()
    {
        try{
            $result['youtube'] = self::getYoutubeLive();
            $result['chzzk'] = self::getChzzkLive();
        }catch(Exception $e) {
            Log::debug($e->getMessage());
        }

        //dd($result);

        return view('liveList',['data'=>$result]);
    }



    private static function getYoutubeLive(): array
    {
        $youtubeApiKey = env('YOUTUBE_API_KEY');
        $regionCode = env('YOUTUBE_REGION');
        
        //key
        $param['key'] = $youtubeApiKey;
        //part 
        $param['part'] = 'snippet';
        //채널id
        $param['maxResults'] = 10;
        //지역코드
        $param['regionCode'] = $regionCode;
        //설정타입
        $param['eventType'] = 'live';
        //타입->eventType live 설정시 type video 지정필수
        $param['type'] = 'video';
        //노출순위
        $param['order'] = 'date';//최신 라이브
        

        try {
            //youtubeAPI 라이브 검색 호출
            $respons = curlGet('https://www.googleapis.com/youtube/v3/search',$param);
            if($respons){
                foreach($respons['items'] as $item){
                    $result[] = [
                            'thumbnail' => isset($item['snippet']['thumbnails']['medium']['url']) ? $item['snippet']['thumbnails']['medium']['url'] : 'none',
                            'title' => $item['snippet']['title'],
                            'videoId' => $item['id']['videoId'],
                            'upTime' => date('Y-m-d H:i:s', strtotime($item['snippet']['publishedAt'])),
                            'channelName' => $item['snippet']['channelTitle']
                            ];
                }

                return $result;
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }


    private static function getChzzkLive(): array
    {       
        //조회갯수
        $param['size'] = 10;
        
        try {
            //youtubeAPI 영상정보 수집 호출
            $respons = curlGet('https://api.chzzk.naver.com/service/v1/lives',$param);

            if($respons){
                foreach($respons['content']['data'] as $item){
                    $result[] = [
                            'thumbnail' => isset($item['liveImageUrl']) ? str_replace("{type}","360",$item['liveImageUrl']) : 'none',
                            'title' => $item['liveTitle'],
                            'videoId' => $item['liveId'],
                            'videoLink' => "https://chzzk.naver.com/live/".$item['channel']['channelId'],
                            'upTime' => date('Y-m-d H:i:s', strtotime($item['openDate'])),
                            'channelName' => $item['channel']['channelName'],
                            ];
                }

                return $result;
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }
}
