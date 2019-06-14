<?php


namespace EasySwoole\Tracker;


class Point
{
    const END_SUCCESS = 'success';
    const END_FAIL = 'fail';
    const END_UNKNOWN = 'unknown';
    protected $startTime;
    protected $startArg;
    protected $endTime;
    protected $pointName;
    protected $file;
    protected $line;
    protected $endStatus = self::END_UNKNOWN;
    protected $endArg;

    function __construct(string $pointName,$arg)
    {
        $this->startArg = $arg;
        $this->pointName = $pointName;
        $this->startTime = round(microtime(true),4);
        $debugTrace = debug_backtrace();
        array_shift($debugTrace);
        $caller = array_shift($debugTrace);
        $this->file = $caller['file'];
        $this->line = $caller['line'];
    }

    function end(string $status = self::END_SUCCESS,$arg = null)
    {
        if($this->endStatus != self::END_UNKNOWN){
           return;
        }
        $this->endStatus = $status;
        $this->endArg = $arg;
        $this->endTime = round(microtime(true),4);
    }

    /**
     * @return float
     */
    public function getStartTime(): float
    {
        return $this->startTime;
    }

    /**
     * @param float $startTime
     */
    public function setStartTime(float $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getStartArg()
    {
        return $this->startArg;
    }

    /**
     * @param mixed $startArg
     */
    public function setStartArg($startArg): void
    {
        $this->startArg = $startArg;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getPointName(): string
    {
        return $this->pointName;
    }

    /**
     * @param string $pointName
     */
    public function setPointName(string $pointName): void
    {
        $this->pointName = $pointName;
    }

    /**
     * @return mixed
     */
    public function getTrace()
    {
        return $this->trace;
    }

    /**
     * @param mixed $trace
     */
    public function setTrace($trace): void
    {
        $this->trace = $trace;
    }

    /**
     * @return string
     */
    public function getEndStatus(): string
    {
        return $this->endStatus;
    }

    /**
     * @param string $endStatus
     */
    public function setEndStatus(string $endStatus): void
    {
        $this->endStatus = $endStatus;
    }

    /**
     * @return mixed
     */
    public function getEndArg()
    {
        return $this->endArg;
    }

    /**
     * @param mixed $endArg
     */
    public function setEndArg($endArg): void
    {
        $this->endArg = $endArg;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line): void
    {
        $this->line = $line;
    }
}