<?php

namespace FourChan\Test\Api;

use FourChan\Api\Board;
use FourChan\Api\FourChanClient;

use Mockery as m;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @test
     */
    public function testSetAndGetBoard()
    {
        $client = new FourChanClient();
        $board = $client->setBoard('v');

        $this->assertInstanceOf(Board::class, $board);
        $this->assertSame('v', $board->getBoardName());
        $this->assertSame($board, $client->getBoard());
    }

    /**
     * @test
     */
    public function testGetBoards()
    {
        $client = m::mock('overload:\GuzzleHttp\Client');
        $client->shouldReceive('request')->andReturn($client);
        $client->shouldReceive('getBody')->andReturn(file_get_contents('./test/boards_response.json'));
        $client = new FourChanClient();
        $list = $client->getBoards();
        $this->assertInstanceOf(Board::class, $list[0]);
    }
}
