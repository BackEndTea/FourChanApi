<?php

namespace FourChan\Test\Util;

use FourChan\Api\Board;
use FourChan\Util\BoardFactory;

class BoardFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testFactory()
    {
        $response = \GuzzleHttp\json_decode(file_get_contents('./test/boards_response.json'), true);
        $boardFactory = new BoardFactory($response);
        $boardList = $boardFactory->getBoardList();
        $this->assertInstanceOf(Board::class, $boardList[0]);
    }
}
