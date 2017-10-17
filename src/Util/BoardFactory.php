<?php


namespace FourChan\Util;

use FourChan\Api\Board;

/**
 * Class BoardFactory
 * @package FourChan\Util
 * @internal
 */
class BoardFactory
{
    /**
     * @var array|Board[]
     */
    protected $boardsList;

    /**
     * BoardFactory constructor.
     *
     * @param array $boards array of board info as retrieved from API
     * @param bool $useSSL True for Https, false for Http
     * @return void
     */
    public function __construct($boards, $useSSL = true)
    {
        $boardList = [];
        foreach ($boards['boards'] as $board) {
            $board = new Board($board['board']);
            $board->setBoardInfo($board);
            array_push($boardList, $board);
        }

        $this->boardsList = $boardList;
    }

    /**
     * Get list of boards
     *
     * @return array|Board[]
     * @internal
     */
    public function getBoardList()
    {
        return $this->boardsList;
    }
}
