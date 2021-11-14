<?php

namespace App\Util;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

require __DIR__ . '/../../vendor/autoload.php';

class HttpUtil
{
    public static function get(string $url,string $endpoint)
    {
        $client = new Client(['base_uri' => $url]);       
        $request = new Request('GET', $endpoint);
        $response = $client->send($request);
        return $response->getBody();
    }

    public static function getById(string $url, string $endpoint, string $id)
    {
        $client = new Client(['base_uri' => $url.$id.'/']);
        $request = new Request('GET', $endpoint);
        $response = $client->send($request);
        return $response->getBody();
    }
}