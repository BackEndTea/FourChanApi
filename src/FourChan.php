<?php

namespace FourChan;

use FourChan\Api\FourChanClient;

/**
 * A service class
 * @package FourChan
 */
class FourChan
{
    public static function board(string $board, bool $useSSL = true)
    {
        $client = self::client($useSSL);
        return $client->setBoard($board);
    }

    /**
     * Get client instance
     */
    protected static function client(bool $useSSL)
    {
        return new FourChanClient($useSSL);
    }
}
