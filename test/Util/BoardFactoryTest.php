<?php

namespace FourChan\Test\Util;

use FourChan\Api\Board;
use FourChan\Util\BoardFactory;

class BoardFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $response = \GuzzleHttp\json_decode(file_get_contents('./test/response.json'), true);
        $boardFactory = new BoardFactory($response);
        $boardList = $boardFactory->getBoardList();
        $this->assertInstanceOf(Board::class, $boardList[0]);
    }
}
