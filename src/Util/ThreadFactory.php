<?php

namespace FourChan\Util;

use FourChan\Api\Thread;

class ThreadFactory
{
    /** @var array|Thread[] */
    private $threadList;

    /**
     * ThreadFactory constructor.
     *
     * @param array $threads array of threads as retrieved from API
     * @param string $board name of the board as found in the url
     * @param bool $useSSL true for https, false for http
     */
    public function __construct($threads, $board, $useSSL = true)
    {
        $this->threadList = $this->flattenThreads($threads, $board, $useSSL);
    }

    /**
     * gets thread list
     *
     * @return array|Thread[]
     */
    public function getThreads()
    {
        return $this->threadList;
    }

    /**
     * Flattens thread structure and instantiates threads
     *
     * @param $threads
     * @param $board
     * @param $useSSL
     * @return array|Thread[]
     */
    protected function flattenThreads($threads, $board, $useSSL)
    {
        $threadList = [];
        foreach ($threads as $thread) {
            foreach ($thread['threads'] as $realThread) {
                $inList = new Thread($realThread['no'], $board, $useSSL);
                array_push($threadList, $inList);
            }
        }
        return $threadList;
    }
}
