<?php


namespace EasySwoole\Tracker;


use EasySwoole\Component\Singleton;
use Swoole\Coroutine;

class TrackerContext
{
    use Singleton;

    protected $deferList = [];
    protected $tracker = [];

    public function __init($cid = null):Tracker
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
            $this->tracker[$cid] = new Tracker();
        }
        return $this->tracker[$cid];
    }

    public static function getTracker(?int $cid = null):Tracker
    {
        return TrackerContext::getInstance()->__init($cid);
    }
}