<?php
namespace App\Lib;

class Redis{
    protected static $instance;
    protected static $config = [
        'host'=> '127.0.0.1',
        'post'=>'6379'
    ];
    /** 
     * 获取redis实例
     * 
     */
    public static function getInstance(){
        if(empty(SELF::$instance)){
            $instance = new Redis();
            $instance->connect(
                SELF::$config['host'],
                SELF::$config['port'],
            );
            self::$instance = $instance;
        }
        return self::$instance;
    }
}