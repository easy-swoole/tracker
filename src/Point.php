<?php


namespace EasySwoole\Tracker;


class Point
{
    const END_SUCCESS = 'SUCCESS';
    const END_FAIL = 'FAIL';
    const END_UNKNOWN = 'UNKNOWN';
    protected $startTime;
    protected $startArg;
    protected $endTime;
    protected $pointName;
    protected $trace;
    protected $endStatus = self::END_UNKNOWN;
    protected $endArg;

    function __construct(string $pointName,$arg)
    {
        $this->startArg = $arg;
        $this->pointName = $pointName;
        $this->startTime = round(microtime(true),4);
    }

    function end($arg = null)
    {
        if($this->endStatus){
           return;
        }
        $this->endStatus = true;
        $this->endArg = $arg;
        $this->endTime = round(microtime(true),4);
    }
}