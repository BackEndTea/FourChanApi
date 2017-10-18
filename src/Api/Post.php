<?php

namespace FourChan\Api;

use FourChan\Util\NoImageException;

class Post
{
    /**
     * @var  array Info of the post
     */
    private $postInfo;

    /**
     * @var string Base url of the images
     */
    private $baseImageUrl;

    public function __construct($postInfo, $board, $useSSL = true)
    {
        $this->postInfo = $postInfo;
        $protocol = $useSSL ? 'https://' : 'http://';
        $this->baseImageUrl = $protocol . 'i.4cdn.org/' .$board . '/';
    }

    /**
     * The full array of this posts info from the api
     *
     * @return array
     */
    public function getFullPostInfo()
    {
        return $this->postInfo;
    }

    /**
     * ID of the post
     *
     * @return int
     */
    public function getID()
    {
        return (int)$this->postInfo['no'];
    }

    /**
     * URL to the image of the post
     *
     * @return string
     * @throws NoImageException
     */
    public function getImageUrl()
    {
        if ($this->hasImage()) {
            return $this->baseImageUrl . $this->postInfo['tim'] . $this->postInfo['ext'];
        }
        throw new NoImageException('No image on post ' . $this->postInfo['no']);
    }

    /**
     * Original file name of the image
     *
     * @return mixed
     * @throws NoImageException
     */
    public function getOriginalFileName()
    {
        if ($this->hasImage()) {
            return $this->postInfo['filename'];
        }
        throw new NoImageException('No image on post ' . $this->postInfo['no']);
    }

    /**
     * Full comment, includes escaped html
     *
     * @return string
     */
    public function getFullComment()
    {
        return $this->postInfo['com'];
    }

    /**
     * True if sticky, false if not
     *
     * @return bool
     */
    public function isSticky()
    {
        return $this->isEntry('sticky');
    }

    /**
     * True is closed, false if no
     *
     * @return bool
     */
    public function isClosed()
    {
        return $this->isEntry('closed');
    }

    /**
     * True if archived, false if not
     *
     * @return bool
     */
    public function isArchived()
    {
        return $this->isEntry('archived');
    }

    /**
     * True if post has an image, false if not
     *
     * @return bool
     */
    public function hasImage()
    {
        return isset($this->postInfo['filename']);
    }

    /**
     * True if entry exists and is 1, false if that is not the case.
     *
     * @param string $toCheck entry in array to check
     * @return bool
     */
    private function isEntry($toCheck)
    {
        return isset($this->postInfo[$toCheck]) ? $this->postInfo[$toCheck] ===1 : false;
    }
}
