<?php


namespace EasySwoole\Tracker;


class Point
{
    protected $startTime;
    protected $startArg;
    protected $endTime;
    protected $pointName;
    protected $trace;
    protected $isEnd = false;
    protected $endArg;

    function __construct(string $pointName,$arg)
    {
        $this->startArg = $arg;
        $this->pointName = $pointName;
        $this->startTime = rand(microtime(true),4);
    }

    function end($arg = null)
    {
        if($this->isEnd){
           return;
        }
        $this->isEnd = true;
        $this->endArg = $arg;
        $this->endTime = rand(microtime(true),4);
    }

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getStartArg()
    {
        return $this->startArg;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return string
     */
    public function getPointName(): string
    {
        return $this->pointName;
    }

    /**
     * @return mixed
     */
    public function getTrace()
    {
        return $this->trace;
    }

    /**
     * @return bool
     */
    public function isEnd(): bool
    {
        return $this->isEnd;
    }

    /**
     * @return mixed
     */
    public function getEndArg()
    {
        return $this->endArg;
    }

}