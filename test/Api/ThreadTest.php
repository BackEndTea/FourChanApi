<?php

namespace FourChan\Test\Api;

use FourChan\Api\Post;
use FourChan\Api\Thread;
use Mockery as m;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ThreadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function getPostsReturnsPosts()
    {
        $client = m::mock('overload:\GuzzleHttp\Client');
        $client->shouldReceive('request')->andReturn($client);
        $client->shouldReceive('getBody')->andReturn(file_get_contents('./test/single_thread_response.json'));
        $thread = new Thread('393603295', 'v', true);
        $list = $thread->getPosts(true);
        $this->assertInstanceOf(Post::class, $list[0]);
        $this->assertSame(393603295, $list[0]->getID());
    }

    /**
     * @test
     */
    public function getPostsReturnsOldListWhenItExistsAndGetNewestIsFalse()
    {
        $client = m::mock('overload:\GuzzleHttp\Client');
        $client->shouldReceive('request')->andReturn($client);
        $client->shouldReceive('getBody')->andReturn(file_get_contents('./test/single_thread_response.json'));
        $thread = new Thread('393603295', 'v');
        $thread->setPosts([new Post(['no' => 5], 'v')]);
        $posts = $thread->getPosts();
        $this->assertInstanceOf(Post::class, $posts[0]);
        $this->assertSame(5, $posts[0]->getID());
    }

    /**
     * @test
     */
    public function isStickyIsFalseWhenNoSticky()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post([], 'v')]);

        $this->assertFalse($thread->isSticky());
    }

    /**
     * @test
     */
    public function isStickyIsTrueWhenSticky()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post(['sticky' => 1], 'v')]);

        $this->assertTrue($thread->isSticky());
    }

    /**
     * @test
     */
    public function isClosedIsFalseWhenNotClosed()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post([], 'v')]);

        $this->assertFalse($thread->isClosed());
    }

    /**
     * @test
     */
    public function isClosedIsTrueWhenClosed()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post(['closed' => 1], 'v')]);

        $this->assertTrue($thread->isClosed());
    }

    /**
     * @test
     */
    public function isArchivedIsFalseWhenNotArchived()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post([], 'v')]);

        $this->assertFalse($thread->isArchived());
    }

    /**
     * @test
     */
    public function isArchivedIsTrueWhenArchived()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post(['archived' => 1], 'v')]);

        $this->assertTrue($thread->isArchived());
    }

    /**
     * @test
     */
    public function getSubjectIsEmptyWhenNoSubject()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post([], 'v')]);

        $this->assertSame('', $thread->getSubject());
    }

    /**
     * @test
     */
    public function getSubjectReturnsSubject()
    {
        $thread = new Thread('888888', 'v');
        $thread->setPosts([new Post(['sub' => 'The Subject'], 'v')]);

        $this->assertSame('The Subject', $thread->getSubject());
    }

    /**
     * @test
     */
    public function getIDReturnsThreadIDasInteger()
    {
        $thread = new Thread('888888', 'v');

        $this->assertSame(888888, $thread->getID());
        $this->assertNotSame('888888', $thread->getID());
    }
}
