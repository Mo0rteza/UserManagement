<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CountryService {

    protected $client;
    protected $baseUri = 'https://restcountries.com/v3.1/';

    public function __construct()
    {
        $this->client =  new Client([
            'base_uri' => $this->baseUri,
        ]);
    }

    public function getCountries()
    {
        try {

            $response = $this->client->get('all', [
                'query' => [
                    'fields' => 'name,currencies',
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'verify' => false,
            ]);
            $data = json_decode($response->getBody(), true);

            // استخراج نام کشور و ارز از نتیجه درخواست
            $result = array_map(function ($country) {
                return [
                    'name' => $country['name']['common'] ?? '',
                    'currency' => array_keys($country['currencies'] ?? [])[0] ?? ''
                ];
            }, $data);

            return response()->json($result);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
