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

    /** @var  bool */
    protected $useSSL;

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
     * @return string|array
     */
    protected function makeRequest($method, $uri = '')
    {
        $response = $this->getClient()->request($method, $uri);
        $body = (string) $response->getBody();

        return \GuzzleHttp\json_decode($body, true);
    }
}
