<?php


namespace EasySwoole\Tracker;


class Tracker
{
    protected $pointList = [];
    protected $attributes = [];

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
}