<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class FetchAfricaVod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $url)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $this->fetchAfricaVodInfoWithUrl($this->url);
        }catch(Exception $e){
            dump($e->getMessage());
        }
    }

    public function fetchAfricaVodInfoWithUrl($url){
        try{
            //dump($url);
            //Client : 웹페이지 요청&응답값 받아오기
            $this->client=new Client([
                'timeout'   => 10,
                'verify'    => false
            ]);

            //$response = $this->client->get($url);         
            //$content = $response->getBody()->getContents();
            //$crawler = new Crawler( $content );
            $crawler = new Crawler(null, $url, useHtml5Parser: true);
            $content = $crawler->registerNamespace('m', 'https://vod.afreecatv.com/');

            dd($crawler);

            $data = $crawler
                    ->filter('.cBox-list ul li')
                    ->each(function (Crawler $node, $i) use($crawler) {
                                //수집구간
                                $vodUrl=$node->filter(".thumbs-box a")->attr("href");
                                $thumbnail=$node->filter(".thumbs-box a img")->attr("src");
                                FetchDetailPage::dispatch($url);
                                return [
                                    "vodUrl"=>$vodUrl,
                                    "thumbnail"=>$thumbnail,
                                ];
                            }
        );

        /*
        *TODO : javascript 동적생성 페이지는 크롤링수집이 어려움. 보류.
        */

        }catch(Exception $e){
            dump($e->getMessage());
        }
        
    }
}
