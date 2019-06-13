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
        $msg = "Tracker Stack:\n";
        $msg .="\tTrackerId:{$this->trackerId}\n";
        $msg .= "\tAttributes:\n";
        foreach ($this->attributes as $key => $attribute){
            $msg .= "\t\t{$key}:{$attribute}\n";
        }
        $msg .= "\tPoints:\n";
        /** @var Point $point */
        foreach ($this->pointList as $point){
            $msg .= "\t\tname:{$point->getPointName()}\n";
            $msg .= "\t\tstartTime:{$point->getStartTime()}\n";
            $msg .= "\t\tendTime:{$point->getEndTime()}\n";
        }
        return $msg;
    }
}