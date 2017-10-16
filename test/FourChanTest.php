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


    public function testBoard()
    {
        $board = FourChan::board('v');
        $this->assertInstanceOf(Board::class, $board);
        $this->assertEquals('v', $board->getBoardName());
    }
}
