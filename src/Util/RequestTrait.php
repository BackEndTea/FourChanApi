<?php

namespace FourChan\Util;

use GuzzleHttp\Client;

trait RequestTrait
{

    /** @var  Client */
    private $client;

    /** @var string  */
    protected $baseUrl;

    /** @var string  */
    protected $baseImageUrl;

    /**
     * Creates the Client object to work with.
     *
     * @param $baseUrl string
     * @internal
     */
    protected function setClient($baseUrl)
    {
        $client = new Client(['base_uri' => $baseUrl]);
        $this->client = $client;
    }

    /**
     * @return Client
     * @internal
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Wrapper for the request function.
     *
     * @param string $method Method type
     * @param string $uri uri
     * @param bool $decodeJson whether or not to decode the json, default is true.
     * @return string|array
     */
    protected function makeRequest($method, $uri, $decodeJson = true)
    {
        $response = $this->getClient()->request($method, $uri);
        $body = (string) $response->getBody();

        if ($decodeJson) {
            return \GuzzleHttp\json_decode($body, true);
        }
        return $body;
    }
}
