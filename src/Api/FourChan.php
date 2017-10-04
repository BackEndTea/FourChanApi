<?php

namespace FourChan\Api;

use FourChan\Util\BoardFactory;
use FourChan\Util\RequestTrait;

/**
 * Class FourChan
 * @package FourChan\Api
 */
class FourChan
{
    use RequestTrait;


    /** @var  Board */
    private $board;
    /** @var  bool */
    protected $useSSL;

    public function __construct($useSSL = true)
    {
        $this->baseUrl = $useSSL ? 'https://a.4cdn.org/' : 'http://a.4cdn.org/';
        $this->baseImageUrl = $useSSL ? 'https://i.4cdn.org' : 'http://i.4cdn.org';
        $this->useSSL = $useSSL;
        $this->setClient($this->baseUrl);
    }


    /**
     * Sets the Board to be used and returns it.
     *
     * @param string $boardName The board name used in the url.
     *  for example: a,b,v etc.
     * @return Board
     */
    public function setBoard($boardName)
    {
        $this->board = new Board($boardName, $this->useSSL);
        return $this->board;
    }

    /**
     * Board getter.
     *
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Gets a fresh list of all the boards.
     *
     * @return array
     */
    public function getBoards()
    {
        $response =  $this->makeRequest('GET', 'boards.json');
        $boardFactory = new BoardFactory($response, $this->useSSL);
        return $boardFactory->getBoardList();
    }
}
