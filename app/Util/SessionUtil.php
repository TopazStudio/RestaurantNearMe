<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/21/2017
 * Time: 10:58 PM
 */

namespace App\Util;
class SessionUtil
{

    /**
     * Create a special key to be used to identify
     * user sessio in redis
     *
     * @return string
    */
    private static function createSaveSessionKey(){
        //TODO: find special algorithm to generate special key per user
        $key = '8049';
        session(['session_key' => $key]);
        return $key;
    }

    /**
     * Creates a new session key and returns it within a
     * key to store values in redis
     *
     * @return string
    */
    public static function newRedisSession(){
        return env('APP_NAME') . ':' . self::createSaveSessionKey();
    }

    public static function getRedisSession(){
        return env('APP_NAME') . ':' . session('session_key');
    }
}