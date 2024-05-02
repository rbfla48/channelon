<?php

use Illuminate\Support\Facades\Http;


function curlGet($url, $params = [], $headers = [])
{
    $response = Http::withHeaders($headers)->get($url, $params);
    
    if ($response->successful()) {
        return $response->json();
    } else {
        // Handle error response
        return null;
    }
}

function curlPost($url, $data = [], $headers = [])
{
    $response = Http::withHeaders($headers)->post($url, $data);
    
    if ($response->successful()) {
        return $response->json();
    } else {
        // Handle error response
        return null;
    }
}