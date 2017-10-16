<?php

namespace FourChan\Api;

class Post
{
    /** @var  array Info of the post */
    private $postInfo;

    public function __construct($postInfo)
    {
        $this->postInfo = $postInfo;
    }

    public function getID()
    {
        return $this->postInfo['no'];
    }
}
