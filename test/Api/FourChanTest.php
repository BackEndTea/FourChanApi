<?php

namespace FourChan\Test\Api;

use FourChan\Api\Board;
use FourChan\Api\FourChan;

use Mockery as m;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class FourChanTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }


    public function testSetAndGetBoard()
    {
        $fourChan = new FourChan();
        $board = $fourChan->setBoard('v');

        $this->assertInstanceOf(Board::class, $board);
        $this->assertEquals('v', $board->getBoardName());
    }

    public function testGetBoards()
    {
        $client = m::mock('overload:\GuzzleHttp\Client');
        $client->shouldReceive('request')->andReturn($client);
        $client->shouldReceive('getBody')->andReturn(file_get_contents('./test/boards_response.json'));
        $fourChan = new FourChan();
        $list = $fourChan->getBoards();
        $this->assertInstanceOf(Board::class, $list[0]);
    }
}
