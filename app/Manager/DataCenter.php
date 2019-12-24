<?php

namespace App\Manager;
use App\Lib\Redis;
class DataCenter 
{
    public static $global;
    static function log($info,$context = [],$level = 'info'){
        if($context){
            echo sprintf("[%s][%s] :%s %s\n",
                date('Y-m-d h:i:s'),
                $level,
                $info,
                json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            );
        }else{
            echo sprintf("[%s][%s] :%s\n",
                date('Y-m-d h:i:s'),
                $level,
                $info
            );
        }
    }
    public static function redis()
    {
        return Redis::getInstance();
    }
}
