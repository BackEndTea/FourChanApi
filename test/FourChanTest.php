<?php

namespace FourChan\Test;

use FourChan\Api\Board;
use FourChan\FourChan;

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

    /**
     * @test
     */
    public function testBoard()
    {
        $board = FourChan::board('v');
        $this->assertInstanceOf(Board::class, $board);
        $this->assertSame('v', $board->getBoardName());
    }
}
