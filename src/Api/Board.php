<?php

namespace FourChan\Api;

use FourChan\Util\RequestTrait;

/**
 * Class Board
 *
 *
 * @package FourChan\Api
 */
class Board
{
    use RequestTrait;

    /** @var  string $boardName  */
    private $boardName;
    /** @var  array|string[] $boardInfo */
    private $boardInfo;

    public function __construct($boardName, $useSSL = true)
    {
        $this->boardName = $boardName;
        $base = $useSSL ? 'https://a.4cdn.org/' : 'http://a.4cdn.org/';
        $baseUri = $base . $boardName . '/';
        $this->setClient($baseUri);
    }

    public function setBoardInfo($boardInfo)
    {
        $this->boardInfo = $boardInfo;
    }

    /**
     * @return string
     */
    public function getBoardName()
    {
        return $this->boardName;
    }
}
