<?php

namespace FourChan\Test\Api;

use FourChan\Api\Board;
use FourChan\Api\Thread;
use Mockery as m;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class BoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \FourChan\Util\NotSetException
     */
    public function getBoardInfoThrowsErrorWhenNotSet()
    {
        $board = new Board('v');
        $board->getBoardInfo();
    }

    /**
     * @test
     */
    public function getBoardInfoReturnsInfo()
    {
        $board = new Board('v');
        $board->setBoardInfo(
            [
                'title' => 'v',
                'per_page' => 15,
                'pages' => 10,
            ]
        );
        $info = $board->getBoardInfo();
        $this->assertEquals('v', $info['title']);
        $this->assertEquals(15, $info['per_page']);
        $this->assertEquals(10, $info['pages']);
    }

    /**
     * @test
     */
    public function getBoardNameGetsName()
    {
        $board = new Board('v');
        $this->assertEquals('v', $board->getBoardName());
    }

    /**
     * @test
     * @expectedException \FourChan\Util\NotSetException
     */
    public function getFullBoardNameThrowsErrorWhenNotSet()
    {
        $board = new Board('v');
        $board->getTitle();
    }

    /**
     * @test
     */
    public function getFullBoardNameReturnsFullName()
    {
        $board = new Board('v');
        $board->getThreads();
        $board->setBoardInfo(['title' => 'anime and manga']);
        $this->assertEquals('anime and manga', $board->getTitle());
    }

    /**
     * @test
     */
    public function getThreadsReturnsThreads()
    {
        $client = m::mock('overload:\GuzzleHttp\Client');
        $client->shouldReceive('request')->andReturn($client);
        $client->shouldReceive('getBody')->andReturn(file_get_contents('./test/threads_response.json'));
        $board = new Board('tg');
        $list = $board->getThreads();
        $this->assertInstanceOf(Thread::class, $list[0]);
    }
}
