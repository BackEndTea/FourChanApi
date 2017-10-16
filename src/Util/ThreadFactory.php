<?php

namespace FourChan\Util;

use FourChan\Api\Thread;

class ThreadFactory
{
    /** @var array|Thread[] */
    private $threadList;

    /**
     * ThreadFactory constructor.
     * @param array $threads array of threads as retrieved from API
     * @param bool $useSSL True for Https, false for Http
     */
    public function __construct($threads, $useSSL = true)
    {
        $this->threadList = $this->flattenThreads($threads);
    }

    /**
     * @return array|Thread[]
     */
    public function getThreads()
    {
        return $this->threadList;
    }

    /**
     * Flattens thread structure and instantiates threads
     * @return array|Thread[]
     */
    protected function flattenThreads($threads)
    {
        $threadList = [];
        foreach ($threads as $thread) {
            foreach ($thread['threads'] as $realThread) {
                $inList = new Thread($realThread['no']);
                array_push($threadList, $inList);
            }
        }
        return $threadList;
    }
}
