<?php

namespace FourChan\Util;

use FourChan\Api\Thread;

class ThreadFactory
{
    /**
     * @var array|Thread[]
     */
    private $threadList;

    /**
     * ThreadFactory constructor.
     *
     * @param array $threads array of threads as retrieved from API
     * @param $board
     * @param bool $useSSL True for Https, false for Http
     * @return void
     */
    public function __construct($threads, $board, $useSSL = true)
    {
        $this->threadList = $this->flattenThreads($threads, $board, $useSSL);
    }

    /**
     * Get all the threads!
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
