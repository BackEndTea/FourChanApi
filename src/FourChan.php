<?php

namespace FourChan;

use FourChan\Api\FourChanClient;

/**
 * A service class
 * @package FourChan
 */
class FourChan
{
    public static function board($board, $useSSL = true)
    {
        $client = self::client($useSSL);
        return $client->setBoard($board);
    }

    /**
     * Get client instance
     */
    protected static function client($useSSL)
    {
        return new FourChanClient($useSSL);
    }
}
