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
}
