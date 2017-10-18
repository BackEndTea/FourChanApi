<?php

namespace FourChan\Test\Api;

use FourChan\Api\Post;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getFullPostInfoReturnsFullArray()
    {
        $info = $this->makePostWithNoImage();
        $post = new Post($info, 'v');

        $this->assertSame($info, $post->getFullPostInfo());
    }

    /**
     * @test
     */
    public function getIDReturnsID()
    {
        $post = new Post($this->makePostWithNoImage(), 'v', true);

        $this->assertSame(393603927, $post->getID());
        $this->assertNotSame('393603927', $post->getID());
    }

    /**
     * @test
     * @expectedException \FourChan\Util\NoImageException
     */
    public function geImageUrlThrowErrorWhenNoImage()
    {
        $post = new Post($this->makePostWithNoImage(), 'v', true);

        $post->getImageUrl();
    }

    /**
     * @test
     */
    public function getImageUrlReturnsHttpsWhenUseSsl()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);

        $this->assertSame('https://i.4cdn.org/v/1508166159763.png', $post->getImageUrl());
    }

    /**
     * @test
     */
    public function getImageUrlReturnsHttpWhenNoUseSsl()
    {
        $post = new Post($this->makePostWithImage(), 'v', false);

        $this->assertSame('http://i.4cdn.org/v/1508166159763.png', $post->getImageUrl());
    }

    /**
     * @test
     * @expectedException \FourChan\Util\NoImageException
     */
    public function getOriginalFileNameThrowsErrorWhenNoImage()
    {
        $post = new Post($this->makePostWithNoImage(), 'v', true);

        $post->getOriginalFileName();
    }

    /**
     * @test
     */
    public function getOriginalFileNameReturnsFileName()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);

        $this->assertSame('1507649434298', $post->getOriginalFileName());
    }

    /**
     * @test
     */
    public function getFullCommentWorksWithNoHTML()
    {
        $post = new Post($this->makePostWithNoImage(), 'v', true);

        $this->assertSame(
            'So how does someone actually play the Konosuba Megaman game? I know it comes with the Bluray season but is it like a code, another disc, any way to just play on pc?',
            $post->getFullComment()
            );
    }

    /**
     * @test
     */
    public function getFullCommentWorksWithHTML()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);

        $this->assertSame(
            "<a href=\"#p393603295\" class=\"quotelink\">&gt;&gt;393603295<\/a><br><span class=\"quote\">&gt;Are we living in the golden age of Metroidvanias?<\/span><br>Iconiclasts&#039; done and will come out this year, so I&#039;d say so.",
            $post->getFullComment()
        );
    }

    /**
     * @test
     */
    public function isStickyIsFalseWhenNoSticky()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);

        $this->assertFalse($post->isSticky());
    }

    /**
     * @test
     */
    public function isStickyIsTrueWhenSticky()
    {
        $info = $this->makePostWithNoImage();
        $info['sticky'] = 1;
        $post = new Post($info, 'v');

        $this->assertTrue($post->isSticky());
    }

    /**
     * @test
     */
    public function isClosedIsFalseWhenNotClosed()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);

        $this->assertFalse($post->isClosed());
    }

    /**
     * @test
     */
    public function isClosedIsTrueWhenClosed()
    {
        $info = $this->makePostWithNoImage();
        $info['closed'] = 1;
        $post = new Post($info, 'v');

        $this->assertTrue($post->isClosed());
    }

    /**
     * @test
     */
    public function isArchivedIsFalseWhenNotArchived()
    {
        $post = new Post($this->makePostWithImage(), 'v', true);
        $this->assertFalse($post->isArchived());
    }

    /**
     * @test
     */
    public function isArchivedIsTrueWhenArchived()
    {
        $info = $this->makePostWithNoImage();
        $info['archived'] = 1;
        $post = new Post($info, 'v');

        $this->assertTrue($post->isArchived());
    }

    /**
     * @test
     */
    public function hasImageIsTrueWhenImage()
    {
        $post = new Post($this->makePostWithImage(), 'v');

        $this->assertTrue($post->hasImage());
    }

    /**
     * @test
     */
    public function hasImageIsFalseWhenNoImage()
    {
        $post = new Post($this->makePostWithNoImage(), 'v');

        $this->assertFalse($post->hasImage());
    }

    /**
     * Entry for a post with no image
     *
     * @return array
     */
    private function makePostWithNoImage()
    {
        return [
            'no' => 393603927,
            'now' => "10\/16\/17(Mon)11:03:21",
            'name' => 'Anonymous',
            'com' => 'So how does someone actually play the Konosuba Megaman game? I know it comes with the Bluray season but is it like a code, another disc, any way to just play on pc?',
            'time' => 1508166201,
            'resto' => 393603295,
        ];
    }

    /**
     * Entry for post with image
     *
     * @return array
     */
    private function makePostWithImage()
    {
        return [
            'no' => 393603871,
            'now' => "10\/16\/17(Mon)11:02:39",
            'name' => 'Anonymous',
            'com' => "<a href=\"#p393603295\" class=\"quotelink\">&gt;&gt;393603295<\/a><br><span class=\"quote\">&gt;Are we living in the golden age of Metroidvanias?<\/span><br>Iconiclasts&#039; done and will come out this year, so I&#039;d say so.",
            'filename' => '1507649434298',
            'ext' => '.png',
            'w' => 925,
            'h' => 109,
            'tn_w' => 125,
            'tn_h' => 14,
            'tim' => 1508166159763,
            'time' => 1508166159,
            'md5' => 'Mae5Zs4ValXpj7Xto1CEyg==',
            'fsize' => 10200,
            'resto' => 393603295,
        ];
    }
}
