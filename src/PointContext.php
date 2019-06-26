<?php


namespace EasySwoole\Tracker;


use EasySwoole\Component\Singleton;
use Swoole\Coroutine;

class PointContext
{
    use Singleton;

    protected $deferList = [];
    protected $tracker = [];

    public function __init(string $name,$cid = null):Point
    {
        if($cid === null){
            $cid = Coroutine::getUid();
            if(!isset($this->deferList[$cid]) && $cid > 0){
                $this->deferList[$cid] = true;
                defer(function ()use($cid){
                    unset($this->deferList[$cid]);
                    unset($this->tracker[$cid]);
                });
            }
        }
        if(!isset($this->tracker[$cid])){
            $this->tracker[$cid] = new Point($name);
        }
        return $this->tracker[$cid];
    }

    public static function getPoint(string $name = 'UNKNOWN', ?int $cid = null):Point
    {
        return PointContext::getInstance()->__init($name,$cid);
    }
}