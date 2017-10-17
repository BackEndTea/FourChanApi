<?php

namespace FourChan\Api;

class Post
{
    /**
     * @var array $postInfo
     */
    protected $postInfo;

    /**
     * Constructs a new post instance
     *
     * @param array $postInfo
     * @return void
     */
    public function __construct($postInfo)
    {
        $this->postInfo = $postInfo;
    }

    /**
     * Get the post ID
     *
     * @return int
     */
    public function getID()
    {
        return $this->postInfo['no'];
    }
}
