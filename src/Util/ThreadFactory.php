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
        $threadList = [];
        foreach ($threads as $thread) {
            foreach ($thread['threads'] as $realThread) {
                $inList = new Thread($realThread['no']);
                array_push($threadList, $inList);
            }
        }
        $this->threadList = $threadList;
    }

    /**
     * @return array|Thread[]
     */
    public function getThreads()
    {
        return $this->threadList;
    }
}
