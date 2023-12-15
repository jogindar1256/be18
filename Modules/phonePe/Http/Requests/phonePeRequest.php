<?php

namespace Modules\PhonePe\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;

class PhonePeRequest
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api-preprod.phonepe.com', // PhonePe API base URL
        ]);
    }

    public function sendPostRequest($endpoint, $data)
    {
        $uri = new Uri($endpoint);

        try {
            $response = $this->client->request('POST', $uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                ],
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                return json_decode($response->getBody(), true);
            } else {
                return [
                    'success' => false,
                    'message' => 'Request failed: ' . $e->getMessage(),
                ];
            }
        }
    }

    public function sendGetRequest($endpoint)
    {
        $uri = new Uri($endpoint);

        try {
            $response = $this->client->request('GET', $uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                return json_decode($response->getBody(), true);
            } else {
                return [
                    'success' => false,
                    'message' => 'Request failed: ' . $e->getMessage(),
                ];
            }
        }
    }
}
