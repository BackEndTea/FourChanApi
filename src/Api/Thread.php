<?php

namespace FourChan\Api;

use FourChan\Util\RequestTrait;

class Thread
{
    use RequestTrait;

    /**
     * @var string Number of the OP of the thread as in the url
     */
    private $threadNo;

    /**
     * @var string name of the board the thread is on, as displayed in the url
     */
    private $board;

    /**
     * @var array Posts in the thread
     */
    private $posts= [];

    /**
     * Thread constructor
     *
     * @param string $threadNo # of OP
     * @param $board
     * @param bool $useSSL
     */
    public function __construct($threadNo, $board, $useSSL = true)
    {
        $this->threadNo = $threadNo;
        $this->board = $board;
        $this->useSSL = $useSSL;
        $base = $useSSL ? 'https://a.4cdn.org/' : 'http://a.4cdn.org/';
        $uri = $base . $board . '/thread/' . $threadNo . '.json';
        $this->baseUrl = $uri;
        $this->setClient($uri);
    }

    /**
     * Will get all the posts of the thread
     * Will do an api call if the posts list is empty, or if refresh is set to true
     *
     * @param bool $getLatest false to use current list of posts, if it is available, true to build a new list
     * @return array|Post[]
     */
    public function getPosts($getLatest = false)
    {
        if (!empty($this->posts) && $getLatest === false) {
            return $this->posts;
        }
        $postList = [];
        $posts = $this->makeRequest('GET');
        foreach ($posts['posts'] as $post) {
            array_push($postList, new Post($post, $this->board, $this->useSSL));
        }
        return $postList;
    }

    /**
     * Overrides posts with own data
     * There is probably a use case for this
     *
     * @internal
     * @param array|Post[] $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return bool
     */
    public function isSticky()
    {
        return $this->isEntry('Sticky');
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->isEntry('Closed');
    }

    /**
     * @return bool
     */
    public function isArchived()
    {
        return $this->isEntry('Archived');
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->getPosts(false)[0]->getSubject();
    }

    /**
     * # of the OP, the one used in the URL
     *
     * @return int
     */
    public function getID()
    {
        return (int) $this->threadNo;
    }


    /**
     * Helper function to grab info from the post object
     *
     * @param string $name name of the function, without 'is' to call. Needs to be properly capitalized
     * @return mixed
     */
    private function isEntry($name)
    {
        return $this->getPosts(false)[0]->{'is'. $name}();
    }
}
