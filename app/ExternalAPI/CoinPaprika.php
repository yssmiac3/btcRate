<?php

namespace App\ExternalAPI;

use GuzzleHttp\Client;

class CoinPaprika implements Coin
{
    const URI = 'https://api.coinpaprika.com/v1/';

    public function __construct()
    {
        $this->client = new Client();
    }

    private function getCertainCoinInfo(string $coinName)
    {
        $coinUri = config('coin.' . strtoupper($coinName));
        if (!$coinUri)
            return false;
        $response = $this->client->request('GET', static::URI . 'tickers/' . $coinUri . '?quotes=UAH', [
            'Content-Type' => 'application/json'
        ]);
        return $response->getBody();
    }

    public function getCertainCoinPrice(string $coinName): float
    {
        $json = json_decode($this->getCertainCoinInfo($coinName));
        return (float) $json->quotes->UAH->price;
    }
}
