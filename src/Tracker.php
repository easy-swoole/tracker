<?php


namespace EasySwoole\Tracker;


use EasySwoole\Utility\Random;

class Tracker
{
    protected $pointList = [];
    protected $attributes = [];
    protected $trackerId;

    function __construct(?string $trackerId = null)
    {
        if(empty($trackerId)){
            $this->trackerId = Random::character(18);
        }
    }

    public function addPoint(string $pointName,$arg = null):Point
    {
        $point = new Point($pointName,$arg);
        $this->pointList[] = $point;
        return $point;
    }

    function addAttribute($key,$val):Tracker
    {
        $this->attributes[$key] = $val;
        return $this;
    }

    function getAttributes():array
    {
        return $this->attributes;
    }

    function getPoints():array
    {
        return $this->pointList;
    }

    function __toString()
    {
        try{
            $msg = "Tracker Stack:\n";
            $msg .="\tTrackerId:{$this->trackerId}\n";
            $msg .= "\tAttributes:\n";
            foreach ($this->attributes as $key => $attribute){
                $msg .= "\t\t{$key}:{$attribute}\n";
            }
            $msg .= "\tPoints:\n";
            /** @var Point $point */
            foreach ($this->pointList as $point){
                $msg .= "\t\t#\n";
                $msg .= "\t\tname:{$point->getPointName()}\n";
                $msg .= "\t\tstatus:{$point->getEndStatus()}\n";
                $msg .= "\t\tfile:{$point->getFile()} line:{$point->getLine()}\n";
                $msg .= "\t\tstartTime:{$point->getStartTime()}\n";
                $msg .= "\t\tstartArg:{$this->argToString($point->getStartArg())}\n";
                $msg .= "\t\tendTime:{$point->getEndTime()}\n";
                $msg .= "\t\tendArg:{$this->argToString($point->getEndArg())}\n";
            }
            return $msg;
        }catch (\Throwable $throwable){
            return $throwable->getMessage();
        }
    }

    private function argToString($arg)
    {
        if($arg == null){
            return 'null';
        }else if(is_array($arg)){
            return json_encode($arg,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        }else{
            return (string)$arg;
        }
    }
}