<?php

namespace FourChan\Api;

use FourChan\Util\NotSetException;
use FourChan\Util\RequestTrait;
use FourChan\Util\ThreadFactory;

class Board
{
    use RequestTrait;

    /** @var  string $boardName  */
    private $boardName;
    /** @var  array|mixed[] $boardInfo */
    private $boardInfo = [];

    public function __construct($boardName, $useSSL = true)
    {
        $this->boardName = $boardName;
        $base = $useSSL ? 'https://a.4cdn.org/' : 'http://a.4cdn.org/';
        $baseUri = $base . $boardName . '/';
        $this->setClient($baseUri);
    }

    /**
     * This is automatically done when creating the boards through the getboards method on the FourChan class
     *
     * @param $boardInfo array with all the board info from the API
     */
    public function setBoardInfo($boardInfo)
    {
        $this->boardInfo = $boardInfo;
    }

    /**
     * Retrieves the full board info as given from the API, false if it was not set
     * @return array|mixed[]
     * @throws NotSetException if the board info hasn't been set through the API.
     */
    public function getBoardInfo()
    {
        if ($this->boardInfo == []) {
            throw new NotSetException('Board info was not set.');
        }
        return $this->boardInfo;
    }

    /**
     * Board name as used in the url
     *
     * @return string
     */
    public function getBoardName()
    {
        return $this->boardName;
    }

    /**
     * Gets full board name as seen on the website, empty string if none set.
     * @return string
     * @throws NotSetException
     */
    public function getTitle()
    {
        if (!isset($this->boardInfo['title'])) {
            throw new NotSetException('Board info was not set.');
        }
        return $this->boardInfo['title'];
    }

    public function getThreads()
    {
        $response = $this->makeRequest('GET', 'threads.json');
        $factory = new ThreadFactory($response, $this->useSSL);
        return $factory->getThreads();
    }
}
